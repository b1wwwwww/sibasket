<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use App\Models\KasKegiatan;
use App\Models\KasAnggota;
use App\Models\PendaftaranKegiatan;
use App\Models\Absensi;
use Illuminate\Database\Seeder;

class KasKegiatanSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua kegiatan yang bertipe "latihan"
        $kegiatanLatihan = Kegiatan::where('kategori', 'latihan')->get();

        foreach ($kegiatanLatihan as $kegiatan) {
            // Cek apakah KasKegiatan sudah ada untuk kegiatan ini
            $kasKegiatan = KasKegiatan::where('kegiatan_id', $kegiatan->id)->first();

            if (!$kasKegiatan) {
                // OPSI B: Hitung berdasarkan jumlah anggota yang HADIR (bukan terdaftar)
                $totalHadir = Absensi::whereHas('pendaftaranKegiatan', function ($query) use ($kegiatan) {
                    $query->where('kegiatan_id', $kegiatan->id);
                })->where('status_kehadiran', 'hadir')->count();

                // Fallback: jika belum ada absensi, hitung dari pendaftaran terlebih dahulu
                if ($totalHadir === 0) {
                    $totalHadir = PendaftaranKegiatan::where('kegiatan_id', $kegiatan->id)
                        ->where('status', 'terdaftar')
                        ->count();
                }

                // Buat KasKegiatan dengan target berdasarkan jumlah hadir
                $kasKegiatan = KasKegiatan::create([
                    'kegiatan_id' => $kegiatan->id,
                    'nominal_kas' => 5000,
                    'target_total' => $totalHadir * 5000,
                ]);

                // Ambil semua pendaftaran yang approve untuk kegiatan ini
                $pendaftaran = PendaftaranKegiatan::where('kegiatan_id', $kegiatan->id)
                    ->where('status', 'terdaftar')
                    ->get();

                // Buat KasAnggota untuk setiap anggota yang terdaftar
                foreach ($pendaftaran as $index => $p) {
                    // 70% bayar, 30% belum bayar (untuk dummy data realistis)
                    $sudahBayar = rand(1, 100) <= 70;

                    KasAnggota::create([
                        'kas_kegiatan_id' => $kasKegiatan->id,
                        'anggota_id' => $p->anggota_id,
                        'status_bayar' => $sudahBayar ? 'sudah_bayar' : 'belum_bayar',
                        'tanggal_bayar' => $sudahBayar ? now()->subDays(rand(0, 3)) : null,
                        'keterangan' => $sudahBayar ? 'Bayar via transfer' : null,
                    ]);
                }
            }
        }
    }
}
