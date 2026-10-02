<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\PendaftaranKegiatan;
use Illuminate\Database\Seeder;

class DummyPendaftaranSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat 3 Kegiatan
        $kegiatan1 = Kegiatan::create([
            'judul' => 'Latihan Rutin Basket - Jumat',
            'deskripsi' => 'Latihan teknik dasar dan fisik.',
            'tanggal' => now()->addDays(2),
            'lokasi' => 'Lapangan Indoor SMK',
            'kuota' => 15,
            'status' => 'published',
        ]);

        $kegiatan2 = Kegiatan::create([
            'judul' => 'Friendly Match vs SMA 1',
            'deskripsi' => 'Pertandingan persahabatan antar sekolah.',
            'tanggal' => now()->addDays(5),
            'lokasi' => 'Court A',
            'kuota' => 10,
            'status' => 'published',
        ]);

        $kegiatan3 = Kegiatan::create([
            'judul' => 'Sparring Internal SIBASKET',
            'deskripsi' => 'Gim internal antar anggota eskul.',
            'tanggal' => now()->addDays(8),
            'lokasi' => 'Lapangan Outdoor',
            'kuota' => null, // Tanpa batas
            'status' => 'published',
        ]);

        // 2. Buat 5 Anggota
        $anggotas = Anggota::factory(5)->create();

        // 3. Daftarkan mereka ke kegiatan-kegiatan (pastikan tidak duplikat)
        foreach ($anggotas as $anggota) {
            // Tiap anggota daftar ke 1 atau 2 kegiatan random
            $kegiatanList = collect([$kegiatan1, $kegiatan2, $kegiatan3])->random(rand(1, 2));
            
            foreach ($kegiatanList as $kegiatan) {
                // Cek dulu biar nggak kena unique constraint error
                $exists = PendaftaranKegiatan::where('anggota_id', $anggota->id)
                    ->where('kegiatan_id', $kegiatan->id)
                    ->exists();

                if (!$exists) {
                    PendaftaranKegiatan::create([
                        'anggota_id' => $anggota->id,
                        'kegiatan_id' => $kegiatan->id,
                        'status' => fake()->randomElement(['terdaftar', 'terdaftar', 'dibatalkan']), // mayoritas terdaftar
                    ]);
                }
            }
        }
    }
}
