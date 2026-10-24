<?php

namespace App\Observers;

use App\Models\PendaftaranKegiatan;
use App\Models\KasKegiatan;
use App\Models\KasAnggota;

class PendaftaranKegiatanObserver
{
    /**
     * Handle the PendaftaranKegiatan "created" event.
     * 
     * Buat KasAnggota ketika anggota terdaftar di kegiatan latihan.
     * Target akan terupdate otomatis via AbsensiObserver saat ada perubahan status hadir.
     */
    public function created(PendaftaranKegiatan $pendaftaran): void
    {
        $kegiatan = $pendaftaran->kegiatan;

        // Jika kegiatan bertipe latihan, tambahkan ke kas anggota
        if ($kegiatan && $kegiatan->kategori === 'latihan') {
            $kasKegiatan = KasKegiatan::where('kegiatan_id', $kegiatan->id)->first();

            if ($kasKegiatan) {
                // Buat record KasAnggota dengan status belum_bayar
                KasAnggota::firstOrCreate([
                    'kas_kegiatan_id' => $kasKegiatan->id,
                    'anggota_id' => $pendaftaran->anggota_id,
                ], [
                    'status_bayar' => 'belum_bayar',
                ]);
            }
        }
    }

    /**
     * Handle the PendaftaranKegiatan "deleted" event.
     * 
     * Hapus KasAnggota jika pendaftaran dibatalkan (dan status belum bayar).
     */
    public function deleted(PendaftaranKegiatan $pendaftaran): void
    {
        $kegiatan = $pendaftaran->kegiatan;

        if ($kegiatan && $kegiatan->kategori === 'latihan') {
            $kasKegiatan = KasKegiatan::where('kegiatan_id', $kegiatan->id)->first();

            if ($kasKegiatan) {
                // Hapus record KasAnggota jika masih belum bayar
                $kasAnggota = KasAnggota::where('kas_kegiatan_id', $kasKegiatan->id)
                    ->where('anggota_id', $pendaftaran->anggota_id)
                    ->first();
                
                if ($kasAnggota && $kasAnggota->status_bayar === 'belum_bayar') {
                    $kasAnggota->delete();
                }
            }
        }
    }
}
