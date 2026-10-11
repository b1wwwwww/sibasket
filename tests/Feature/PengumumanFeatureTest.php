<?php

namespace Tests\Feature;

use App\Livewire\PengumumanForm;
use App\Livewire\PengumumanTable;
use App\Models\Pengumuman;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PengumumanFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RolePermissionSeeder']);
        $this->admin = User::factory()->create();
        $this->admin->assignRole('admin');
    }

    /**
     * Test: PengumumanTable component dapat ditampilkan
     */
    public function test_pengumuman_table_dapat_ditampilkan()
    {
        Pengumuman::factory()->count(3)->create();

        $response = Livewire::actingAs($this->admin)
            ->test(PengumumanTable::class);

        $response->assertStatus(200);
    }

    /**
     * Test: PengumumanTable menampilkan semua pengumuman
     */
    public function test_pengumuman_table_menampilkan_semua_pengumuman()
    {
        $pengumuman = Pengumuman::factory()->create([
            'judul' => 'Test Pengumuman',
        ]);

        $response = Livewire::actingAs($this->admin)
            ->test(PengumumanTable::class);

        $response->assertSee($pengumuman->judul);
    }

    /**
     * Test: PengumumanTable search berfungsi
     */
    public function test_pengumuman_table_search_berfungsi()
    {
        Pengumuman::factory()->create(['judul' => 'Jadwal Latihan']);
        Pengumuman::factory()->create(['judul' => 'Pengumuman Penting']);

        $response = Livewire::actingAs($this->admin)
            ->test(PengumumanTable::class);

        $response->set('search', 'Jadwal');
        $response->assertSee('Jadwal Latihan');
    }

    /**
     * Test: PengumumanForm dapat membuat pengumuman baru
     */
    public function test_pengumuman_form_dapat_membuat_pengumuman()
    {
        $response = Livewire::actingAs($this->admin)
            ->test(PengumumanForm::class);

        $response->set('judul', 'New Pengumuman');
        $response->set('isi', 'This is new pengumuman');
        $response->set('tanggal_publish', now()->format('Y-m-d'));

        $response->call('save');

        $this->assertDatabaseHas('pengumuman', [
            'judul' => 'New Pengumuman',
        ]);
    }

    /**
     * Test: PengumumanForm dapat mengedit pengumuman
     */
    public function test_pengumuman_form_dapat_mengedit_pengumuman()
    {
        $pengumuman = Pengumuman::factory()->create();

        $response = Livewire::actingAs($this->admin)
            ->test(PengumumanForm::class, ['pengumuman_id' => $pengumuman->id]);

        $response->assertSet('judul', $pengumuman->judul);
        $response->assertSet('isi', $pengumuman->isi);

        $response->set('judul', 'Updated Title');
        $response->call('save');

        $this->assertDatabaseHas('pengumuman', [
            'id' => $pengumuman->id,
            'judul' => 'Updated Title',
        ]);
    }

    /**
     * Test: PengumumanTable dapat menghapus pengumuman
     */
    public function test_pengumuman_table_dapat_menghapus_pengumuman()
    {
        $pengumuman = Pengumuman::factory()->create();

        $response = Livewire::actingAs($this->admin)
            ->test(PengumumanTable::class);

        $response->call('delete', $pengumuman->id);

        $this->assertDatabaseMissing('pengumuman', [
            'id' => $pengumuman->id,
        ]);
    }

    /**
     * Test: Admin dapat mengakses halaman pengumuman
     */
    public function test_admin_dapat_mengakses_halaman_pengumuman()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('pengumuman.index'));

        $response->assertStatus(200);
    }

    /**
     * Test: Admin dapat mengakses form create pengumuman
     */
    public function test_admin_dapat_mengakses_form_create()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('pengumuman.create'));

        $response->assertStatus(200);
    }

    /**
     * Test: Admin dapat mengakses form edit pengumuman
     */
    public function test_admin_dapat_mengakses_form_edit()
    {
        $pengumuman = Pengumuman::factory()->create();

        $response = $this->actingAs($this->admin)
            ->get(route('pengumuman.edit', $pengumuman->id));

        $response->assertStatus(200);
    }
}
