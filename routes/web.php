<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// ========== ROUTE PUBLIK (tanpa autentikasi) ==========

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/kegiatan-publik', function () {
    return view('pages.kegiatan-publik');
})->name('kegiatan.publik');

Route::get('/kegiatan/{id}', function ($id) {
    return view('pages.kegiatan-detail', ['id' => $id]);
})->name('kegiatan.detail');

Route::get('/pengumuman-publik', function () {
    return view('pages.pengumuman-publik');
})->name('pengumuman.publik');

Route::get('/pengumuman/{id}', function ($id) {
    return view('pages.pengumuman-detail', ['id' => $id]);
})->name('pengumuman.detail');

Route::get('/daftar-anggota', function () {
    return view('pages.daftar-anggota');
})->name('daftar.anggota');

// ========== ROUTE AUTENTIKASI ==========

Route::get('/auth/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');

// ========== ROUTE TERLINDUNGI (memerlukan autentikasi) ==========

Route::middleware(['auth'])->group(function () {
    // Dashboard utama
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');

    // ===== Manajemen Anggota =====
    Route::middleware(['can:view anggota'])->group(function () {
        Route::get('/dashboard/anggota', function () {
            return view('pages.anggota');
        })->name('anggota.index');

        Route::get('/dashboard/anggota/create', function () {
            return view('pages.anggota-create');
        })->name('anggota.create');

        Route::get('/dashboard/anggota/{id}/edit', function ($id) {
            return view('pages.anggota-edit', ['id' => $id]);
        })->name('anggota.edit');
    });

    // ===== Manajemen Kegiatan =====
    Route::middleware(['can:view kegiatan'])->group(function () {
        Route::get('/dashboard/kegiatan', function () {
            return view('pages.kegiatan');
        })->name('kegiatan.index');

        Route::get('/dashboard/kegiatan/create', function () {
            return view('pages.kegiatan-create');
        })->name('kegiatan.create');

        Route::get('/dashboard/kegiatan/{id}/edit', function ($id) {
            return view('pages.kegiatan-edit', ['id' => $id]);
        })->name('kegiatan.edit');
    });

    // ===== Pendaftaran Kegiatan =====
    Route::middleware(['can:view pendaftaran_kegiatan'])->group(function () {
        Route::get('/dashboard/pendaftaran-kegiatan', function () {
            return view('pages.pendaftaran-kegiatan');
        })->name('pendaftaran-kegiatan.index');
    });

    // ===== Manajemen Absensi =====
    Route::middleware(['can:view absensi'])->group(function () {
        Route::get('/dashboard/absensi', function () {
            return view('pages.absensi');
        })->name('absensi.index');

        Route::get('/dashboard/absensi/create', function () {
            return view('pages.absensi-create');
        })->name('absensi.create');

        Route::get('/dashboard/recap-absensi', function () {
            return view('pages.recap-absensi');
        })->name('recap-absensi.index');
    });

    // ===== Manajemen Keuangan =====
    Route::middleware(['can:view keuangan'])->group(function () {
        Route::get('/dashboard/keuangan', function () {
            return view('pages.keuangan');
        })->name('keuangan.index');

        Route::get('/dashboard/keuangan/create', function () {
            return view('pages.keuangan-create');
        })->name('keuangan.create');

        Route::get('/dashboard/keuangan/{id}/edit', function ($id) {
            return view('pages.keuangan-edit', ['id' => $id]);
        })->name('keuangan.edit');
    });

    // ===== Manajemen Pengumuman =====
    Route::middleware(['can:view pengumuman'])->group(function () {
        Route::get('/dashboard/pengumuman', function () {
            return view('pages.pengumuman');
        })->name('pengumuman.index');

        Route::get('/dashboard/pengumuman/create', function () {
            return view('pages.pengumuman-create');
        })->name('pengumuman.create');

        Route::get('/dashboard/pengumuman/{id}/edit', function ($id) {
            return view('pages.pengumuman-edit', ['id' => $id]);
        })->name('pengumuman.edit');
    });

    // ===== Role & Permission (Super Admin saja) =====
    Route::middleware(['role:Super Admin'])->group(function () {
        Route::get('/dashboard/role-permission', function () {
            return view('pages.role-permission');
        })->name('role-permission.index');
    });

    // ===== View-only untuk Member =====
    Route::middleware(['role:Member'])->group(function () {
        Route::get('/dashboard/riwayat-absensi', function () {
            return view('pages.riwayat-absensi');
        })->name('riwayat-absensi.index');

        Route::get('/dashboard/riwayat-pembayaran', function () {
            return view('pages.riwayat-pembayaran');
        })->name('riwayat-pembayaran.index');
    });
});

require __DIR__.'/auth.php';
