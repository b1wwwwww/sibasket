<?php

namespace App\Jobs;

use App\Models\Kegiatan;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Carbon\Carbon;

class UpdateKegiatanStatusJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     * 
     * Auto-update status kegiatan berdasarkan waktu:
     * - published → ongoing (saat tanggal_mulai tiba)
     * - ongoing → completed (saat tanggal_selesai tiba, jika ada)
     */
    public function handle(): void
    {
        $now = Carbon::now();

        // 1. Update kegiatan dari published → ongoing (tanggal_mulai sudah tiba)
        Kegiatan::where('status', 'published')
            ->where('tanggal', '<=', $now)
            ->update(['status' => 'ongoing']);

        // 2. Update kegiatan dari ongoing → completed (tanggal_selesai sudah tiba)
        Kegiatan::where('status', 'ongoing')
            ->whereNotNull('tanggal_selesai')
            ->where('tanggal_selesai', '<=', $now)
            ->update(['status' => 'completed']);
    }
}
