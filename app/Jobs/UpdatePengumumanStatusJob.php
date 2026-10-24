<?php

namespace App\Jobs;

use App\Models\Pengumuman;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Carbon\Carbon;

class UpdatePengumumanStatusJob implements ShouldQueue
{
    use Queueable;

    public function handle(): void
    {
        // Auto-publish pengumuman yang sudah waktunya
        $now = Carbon::now();

        Pengumuman::where('status', 'draft')
            ->where('scheduled_at', '<=', $now)
            ->update([
                'status' => 'published',
                'tanggal_publish' => $now,
            ]);
    }
}
