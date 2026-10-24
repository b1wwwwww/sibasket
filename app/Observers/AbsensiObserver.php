<?php

namespace App\Observers;

use App\Models\Absensi;
use App\Models\KasKegiatan;

class AbsensiObserver
{
    /**
     * Handle the Absensi "updated" event.
     * 
     * Jika status kehadiran berubah, update target_total di KasKegiatan
     * berdasarkan jumlah anggota yang hadir (status_kehadiran = 'hadir').
     */
    public function updated(Absensi $absensi): void
    {
        // Cek apakah status_kehadiran yang berubah
        if ($absensi->isDirty('status_kehadiran')) {
            $pendaftaran = $absensi->pendaftaranKegiatan;
            $kegiatan = $pendaftaran->kegiatan;

            // Jika kegiatan bertipe latihan, hitung ulang target_total
            if ($kegiatan && $kegiatan->kategori === 'latihan') {
                $kasKegiatan = KasKegiatan::where('kegiatan_id', $kegiatan->id)->first();

                if ($kasKegiatan) {
                    // Hitung jumlah anggota yang hadir untuk kegiatan ini
                    $jumlahHadir = Absensi::whereHas('pendaftaranKegiatan', function ($query) use ($kegiatan) {
                        $query->where('kegiatan_id', $kegiatan->id);
                    })
                    ->where('status_kehadiran', 'hadir')
                    ->count();

                    // Update target_total berdasarkan jumlah yang hadir
                    $kasKegiatan->update([
                        'target_total' => $jumlahHadir * $kasKegiatan->nominal_kas,
                    ]);
                }
            }
        }
    }

    /**
     * Handle the Absensi "created" event.
     * 
     * Jika absensi baru dibuat dengan status 'hadir', increment target_total.
     */
    public function created(Absensi $absensi): void
    {
        if ($absensi->status_kehadiran === 'hadir') {
            $pendaftaran = $absensi->pendaftaranKegiatan;
            $kegiatan = $pendaftaran->kegiatan;

            if ($kegiatan && $kegiatan->kategori === 'latihan') {
                $kasKegiatan = KasKegiatan::where('kegiatan_id', $kegiatan->id)->first();

                if ($kasKegiatan) {
                    $kasKegiatan->increment('target_total', $kasKegiatan->nominal_kas);
                }
            }
        }
    }

    /**
     * Handle the Absensi "deleted" event.
     * 
     * Jika absensi dihapus dan statusnya 'hadir', decrement target_total.
     */
    public function deleted(Absensi $absensi): void
    {
        if ($absensi->status_kehadiran === 'hadir') {
            $pendaftaran = $absensi->pendaftaranKegiatan;
            
            // Jika pendaftaran masih ada (belum dihapus)
            if ($pendaftaran) {
                $kegiatan = $pendaftaran->kegiatan;

                if ($kegiatan && $kegiatan->kategori === 'latihan') {
                    $kasKegiatan = KasKegiatan::where('kegiatan_id', $kegiatan->id)->first();

                    if ($kasKegiatan && $kasKegiatan->target_total > 0) {
                        $kasKegiatan->decrement('target_total', $kasKegiatan->nominal_kas);
                    }
                }
            }
        }
    }
}
