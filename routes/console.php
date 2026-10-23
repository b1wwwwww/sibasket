<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Auto-update kegiatan status setiap 5 menit
Schedule::job(\App\Jobs\UpdateKegiatanStatusJob::class)->everyFiveMinutes();
