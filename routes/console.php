<?php

use Illuminate\Support\Facades\Schedule;
use App\Jobs\UpdateKegiatanStatusJob;
use App\Jobs\GenerateJadwalRutinJob;

// Update status kegiatan (published -> ongoing -> completed)
Schedule::job(new UpdateKegiatanStatusJob)->everyFiveMinutes()->withoutOverlapping();

// ===== Auto-Generate Kegiatan Rutin (H-2 sebelum latihan) =====

// Minggu 21:00 → Generate Selasa (2 hari sebelum latihan Selasa)
Schedule::job(new GenerateJadwalRutinJob('selasa'))
    ->weeklyOn(0, '21:00')  // 0 = Sunday
    ->withoutOverlapping();

// Rabu 21:00 → Generate Jumat (2 hari sebelum latihan Jumat)
Schedule::job(new GenerateJadwalRutinJob('jumat'))
    ->weeklyOn(3, '21:00')  // 3 = Wednesday
    ->withoutOverlapping();

// Kamis 21:00 → Generate Sabtu (2 hari sebelum latihan Sabtu)
Schedule::job(new GenerateJadwalRutinJob('sabtu'))
    ->weeklyOn(4, '21:00')  // 4 = Thursday
    ->withoutOverlapping();
