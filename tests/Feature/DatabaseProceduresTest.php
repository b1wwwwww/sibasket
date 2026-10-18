<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Anggota;
use App\Models\PendaftaranAnggota;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DatabaseProceduresTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Setup Spatie permission dan role
        $this->app['config']->set('permission.enable_wildcard_permission', true);
        Role::firstOrCreate(['name' => 'Member']);
    }

    /**
     * Test Stored Procedure: sp_approve_pendaftaran_anggota
     * Verify: User created, Anggota created, Status updated
     */
    public function test_sp_approve_pendaftaran_anggota_creates_user_and_anggota()
    {
        // Setup
        $pendaftaranAnggota = PendaftaranAnggota::factory()->create([
            'nama' => 'Budi Santoso',
            'nis' => '001',
            'kelas' => '10A',
            'jurusan' => 'pplg',
            'status' => 'pending'
        ]);

        // Execute procedure dengan statement (bukan call)
        DB::statement('CALL sp_approve_pendaftaran_anggota(?, @user_id, @password)', [
            $pendaftaranAnggota->id
        ]);

        // Get output
        $result = DB::select('SELECT @user_id as user_id, @password as password')[0];

        // Assert: User dibuat
        $this->assertNotNull($result->user_id);
        $user = User::find($result->user_id);
        $this->assertNotNull($user);
        $this->assertEquals('Budi Santoso', $user->name);

        // Assert: Anggota dibuat
        $anggota = Anggota::where('user_id', $result->user_id)->first();
        $this->assertNotNull($anggota);
        $this->assertEquals('001', $anggota->nis);
        $this->assertEquals('Budi Santoso', $anggota->nama);
        $this->assertEquals('aktif', $anggota->status);

        // Assert: Role 'member' di-assign (cek di DB langsung, bypass Spatie cache)
        $memberRoleId = DB::table('roles')->where('name', 'member')->value('id');
        $roleAssignment = DB::select(
            "SELECT * FROM model_has_roles WHERE model_id = ? AND role_id = ?",
            [$result->user_id, $memberRoleId]
        );
        $this->assertCount(1, $roleAssignment, 'User harus memiliki role member');

        // Assert: Pendaftaran status approved
        $pendaftaranAnggota->refresh();
        $this->assertEquals('approved', $pendaftaranAnggota->status);
        $this->assertNotNull($pendaftaranAnggota->anggota_id);
    }

    /**
     * Test Stored Procedure: sp_approve_pendaftaran_anggota
     * Verify password awal di-generate dengan format NIS_randomstring
     */
    public function test_sp_approve_pendaftaran_anggota_generates_password()
    {
        $pendaftaranAnggota = PendaftaranAnggota::factory()->create([
            'nis' => '002',
            'jurusan' => 'pplg',
        ]);

        DB::statement('CALL sp_approve_pendaftaran_anggota(?, @user_id, @password)', [
            $pendaftaranAnggota->id
        ]);

        $result = DB::select('SELECT @password as password')[0];

        // Password harus mulai dengan NIS
        $this->assertStringStartsWith('002_', $result->password);
    }
}
