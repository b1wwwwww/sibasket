<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Setup role & permission terlebih dahulu
        $this->call(RolePermissionSeeder::class);

        // Buat admin user setelah role tersedia
        $this->call(AdminUserSeeder::class);

        // Buat test users untuk role testing (Admin, Pembina, Member)
        $this->call(TestUserSeeder::class);

        // User::factory(10)->create();

        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => 'password123',
            ]
        );

        // Jalankan seeder dummy pendaftaran kegiatan
        $this->call(DummyPendaftaranSeeder::class);

        // Jalankan seeder absensi
        $this->call(AbsensiSeeder::class);

        // Jalankan seeder kas kegiatan (iuran per latihan)
        $this->call(KasKegiatanSeeder::class);

        // Jalankan seeder pengeluaran operasional
        $this->call(PengeluaranOperasionalSeeder::class);

        // Jalankan seeder transaksi kas
        $this->call(TransaksiKasSeeder::class);

        // Jalankan seeder pengumuman
        $this->call(PengumumanSeeder::class);

        // Jalankan seeder jadwal latihan
        $this->call(JadwalLatihanSeeder::class);
    }
}
