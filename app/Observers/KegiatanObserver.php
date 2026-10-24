<?php

namespace App\Observers;

use App\Models\Kegiatan;
use App\Models\KasKegiatan;
use App\Models\PendaftaranKegiatan;

class KegiatanObserver
{
    /**
     * Handle the Kegiatan "created" event.
     */
    public function created(Kegiatan $kegiatan): void
    {
        // Jika kategori adalah 'latihan', auto-create KasKegiatan
        if ($kegiatan->kategori === 'latihan') {
            // OPSI B: Mulai dengan target = 0 (belum ada absensi saat kegiatan baru dibuat)
            // Target akan terupdate otomatis saat ada perubahan status absensi (melalui AbsensiObserver)
            KasKegiatan::create([
                'kegiatan_id' => $kegiatan->id,
                'nominal_kas' => 5000,
                'target_total' => 0, // Mulai dari 0, akan terupdate saat ada absensi
            ]);
        }
    }

    /**
     * Handle the Kegiatan "updated" event.
     */
    public function updated(Kegiatan $kegiatan): void
    {
        // Jika kategori berubah menjadi 'latihan' dan belum ada KasKegiatan
        if ($kegiatan->kategori === 'latihan' && !$kegiatan->kasKegiatan()->exists()) {
            $totalTerdaftar = PendaftaranKegiatan::where('kegiatan_id', $kegiatan->id)
                ->where('status', 'terdaftar')
                ->count();

            if ($totalTerdaftar === 0) {
                $totalTerdaftar = $kegiatan->kuota ?? 15;
            }

            KasKegiatan::create([
                'kegiatan_id' => $kegiatan->id,
                'nominal_kas' => 5000,
                'target_total' => $totalTerdaftar * 5000,
            ]);
        }
    }
}
