<?php

namespace Database\Seeders;

use App\Models\Absensi;
use App\Models\PendaftaranKegiatan;
use Illuminate\Database\Seeder;

class AbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pendaftarans = PendaftaranKegiatan::where('status', 'terdaftar')->get();

        if ($pendaftarans->isEmpty()) {
            $this->command->warn('Tidak ada pendaftaran terdaftar. Jalankan PendaftaranKegiatanSeeder terlebih dahulu.');
            return;
        }

        foreach ($pendaftarans as $p) {
            // 60% hadir, 15% izin, 15% sakit, 10% alpa
            $statusKehadiran = fake()->randomElement([
                'hadir', 'hadir', 'hadir', 'hadir', 'hadir', 'hadir',
                'izin', 'izin', 'sakit', 'sakit', 'alpa'
            ]);

            $catatan = null;
            if ($statusKehadiran === 'izin') {
                $catatan = fake()->randomElement(['Acara keluarga', 'Pekerjaan lain']);
            } elseif ($statusKehadiran === 'sakit') {
                $catatan = 'Sakit';
            } elseif ($statusKehadiran === 'alpa') {
                $catatan = 'Tidak memberitahu';
            }

            Absensi::create([
                'pendaftaran_id' => $p->id,
                'status_kehadiran' => $statusKehadiran,
                'catatan' => $catatan,
            ]);
        }

        $this->command->info('Absensi seeded successfully.');
    }
}
