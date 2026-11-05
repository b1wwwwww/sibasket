<?php

namespace App\Jobs;

use App\Models\JadwalLatihan;
use App\Models\Kegiatan;
use App\Models\Anggota;
use App\Models\PendaftaranKegiatan;
use App\Mail\DeklarasiStatusReminder;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class GenerateJadwalRutinJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $hari; // 'selasa', 'jumat', 'sabtu'

    public function __construct($hari = null)
    {
        $this->hari = $hari;
    }

    public function handle()
    {
        // Query jadwal berdasarkan hari (atau semua jika null)
        $query = JadwalLatihan::where('aktif', true);
        
        if ($this->hari) {
            $query->where('hari', strtolower($this->hari));
        }

        $jadwalAktif = $query->get();

        foreach ($jadwalAktif as $jadwal) {
            // Tentukan tanggal kegiatan (sesuai hari)
            $targetDate = $this->getNextDateForDay($jadwal->hari);

            // Cek apakah sudah ada kegiatan di tanggal tersebut
            $exists = Kegiatan::where('tanggal', $targetDate->toDateString())
                              ->where('jadwal_latihan_id', $jadwal->id)
                              ->exists();

            if (!$exists) {
                DB::transaction(function () use ($jadwal, $targetDate) {
                    $kegiatan = Kegiatan::create([
                        'judul' => 'Latihan Rutin - ' . ucfirst($jadwal->hari),
                        'deskripsi' => 'Latihan rutin hari ' . ucfirst($jadwal->hari) . ' di ' . $jadwal->lokasi,
                        'tanggal' => $targetDate->toDateString(),
                        'lokasi' => $jadwal->lokasi,
                        'kategori' => 'latihan',
                        'status' => 'published',
                        'jadwal_latihan_id' => $jadwal->id,
                    ]);

                    // Auto-daftarkan semua anggota aktif
                    $anggotaAktif = Anggota::where('status', 'aktif')->get();
                    foreach ($anggotaAktif as $anggota) {
                        PendaftaranKegiatan::create([
                            'kegiatan_id' => $kegiatan->id,
                            'anggota_id' => $anggota->id,
                            'status' => 'terdaftar',
                        ]);

                        // Send email reminder (queue)
                        $user = $anggota->user;
                        if ($user && $user->email) {
                            Mail::to($user->email)->queue(new DeklarasiStatusReminder($kegiatan, $anggota->nama));
                        }
                    }
                });
            }
        }
    }

    /**
     * Get next occurrence of a specific day
     * Contoh: 'selasa' sekarang hari Minggu → return Selasa (2 hari depan)
     */
    private function getNextDateForDay($dayName)
    {
        $days = ['minggu' => 0, 'senin' => 1, 'selasa' => 2, 'rabu' => 3, 'kamis' => 4, 'jumat' => 5, 'sabtu' => 6];
        $targetDay = $days[strtolower($dayName)];
        $today = Carbon::now();
        
        // Jika hari target belum tercapai minggu ini, hitung dari minggu depan
        $nextOccurrence = $today->copy()->startOfWeek()->addDays($targetDay);
        
        if ($nextOccurrence->isPast()) {
            $nextOccurrence->addWeek();
        }

        return $nextOccurrence;
    }
}
