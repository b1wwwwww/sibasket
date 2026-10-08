<?php

namespace Tests\Feature;

use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\PendaftaranKegiatan;
use App\Models\User;
use App\Livewire\PendaftaranKegiatanForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PendaftaranKegiatanTest extends TestCase
{
    use RefreshDatabase;

    public function test_anggota_can_register_for_kegiatan()
    {
        $user = User::factory()->create();
        $anggota = Anggota::create([
            'user_id' => $user->id,
            'nis' => '12345',
            'nama' => 'Test Anggota',
            'kelas' => 'X',
            'jurusan' => 'pplg',
            'status' => 'aktif',
            'tanggal_bergabung' => now(),
        ]);

        $kegiatan = Kegiatan::create([
            'judul' => 'Latihan Basket',
            'tanggal' => now()->addDays(1),
            'lokasi' => 'Gor',
            'kuota' => 10,
            'status' => 'published',
        ]);

        Livewire::actingAs($user)
            ->test(PendaftaranKegiatanForm::class, ['kegiatan' => $kegiatan])
            ->call('daftar')
            ->assertHasNoErrors()
            ->assertSee('Berhasil mendaftar');

        $this->assertDatabaseHas('pendaftaran_kegiatan', [
            'anggota_id' => $anggota->id,
            'kegiatan_id' => $kegiatan->id,
            'status' => 'terdaftar',
        ]);
    }

    public function test_anggota_cannot_register_if_kuota_full()
    {
        $user = User::factory()->create();
        $anggota = Anggota::create([
            'user_id' => $user->id,
            'nis' => '12345',
            'nama' => 'Test Anggota',
            'kelas' => 'X',
            'jurusan' => 'pplg',
            'status' => 'aktif',
            'tanggal_bergabung' => now(),
        ]);

        // Buat anggota lain untuk isi kuota
        $anggotaLain = Anggota::create([
            'user_id' => User::factory()->create()->id,
            'nis' => '54321',
            'nama' => 'Test Anggota Lain',
            'kelas' => 'XI',
            'jurusan' => 'elektro',
            'status' => 'aktif',
            'tanggal_bergabung' => now(),
        ]);

        $kegiatan = Kegiatan::create([
            'judul' => 'Latihan Penuh',
            'tanggal' => now()->addDays(1),
            'lokasi' => 'Gor',
            'kuota' => 1,
            'status' => 'published',
        ]);

        // Isi kuota dengan anggota lain
        PendaftaranKegiatan::create([
            'anggota_id' => $anggotaLain->id,
            'kegiatan_id' => $kegiatan->id,
            'status' => 'terdaftar',
        ]);

        Livewire::actingAs($user)
            ->test(PendaftaranKegiatanForm::class, ['kegiatan' => $kegiatan])
            ->call('daftar')
            ->assertSee('kuota kegiatan ini sudah penuh');
    }
}
