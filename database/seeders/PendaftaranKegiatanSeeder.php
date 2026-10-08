<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\PendaftaranKegiatan;
use Illuminate\Database\Seeder;

class PendaftaranKegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kegiatan = Kegiatan::all();
        $anggota = Anggota::where('status', 'aktif')->get();

        if ($kegiatan->isEmpty() || $anggota->isEmpty()) {
            $this->command->warn('Pastikan KegiatanSeeder dan AnggotaSeeder sudah dijalankan terlebih dahulu.');
            return;
        }

        foreach ($kegiatan as $k) {
            // Ambil 3-5 anggota random untuk daftar ke setiap kegiatan
            $anggotaRandom = $anggota->random(min(5, $anggota->count()));

            foreach ($anggotaRandom as $a) {
                // Jangan duplikasi
                if (PendaftaranKegiatan::where('anggota_id', $a->id)
                    ->where('kegiatan_id', $k->id)
                    ->exists()) {
                    continue;
                }

                PendaftaranKegiatan::create([
                    'anggota_id' => $a->id,
                    'kegiatan_id' => $k->id,
                    'status' => fake()->randomElement(['terdaftar', 'dibatalkan']),
                ]);
            }
        }

        $this->command->info('PendaftaranKegiatan seeded successfully.');
    }
}
