<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ========== ROUTE PUBLIK (tanpa autentikasi) ==========

Route::get('/', function () {
    try {
        $kegiatan = \App\Models\Kegiatan::whereIn('status', ['published', 'ongoing'])
            ->orderBy('tanggal', 'asc')
            ->take(4)
            ->get();

        $pengumuman = \App\Models\Pengumuman::where('status', 'published')
            ->orderByDesc('is_pinned')
            ->orderByDesc('tanggal_publish')
            ->take(4)
            ->get();
    } catch (\Throwable $e) {
        $kegiatan = collect();
        $pengumuman = collect();
    }

    return view('pages.home', compact('kegiatan', 'pengumuman'));
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

// Gallery publik
Route::get('/galeri', function () {
    return view('pages.gallery');
})->name('gallery.index');

Route::get('/galeri/{id}', function ($id) {
    return view('pages.gallery-detail', ['id' => $id]);
})->name('gallery.show');

// ========== ROUTE TERLINDUNGI (memerlukan autentikasi) ==========

Route::middleware(['auth'])->group(function () {
    // Dashboard utama (role-specific metrics)
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

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

        // NEW: Pendaftar Baru (approval flow)
        Route::get('/dashboard/pendaftar-baru', function () {
            return view('pages.pendaftaran-anggota');
        })->name('pendaftar-baru.index');
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

    // Route khusus Member untuk melihat daftar kegiatan & daftar
    Route::get('/dashboard/daftar-kegiatan', function () {
        return view('pages.kegiatan-member');
    })->name('member.kegiatan');

    Route::get('/dashboard/daftar-kegiatan/{kegiatan}', function (\App\Models\Kegiatan $kegiatan) {
        return view('pages.kegiatan-detail-member', ['kegiatan' => $kegiatan]);
    })->name('member.kegiatan-detail');


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

        // Export Absensi
        Route::get('/dashboard/absensi/export', [\App\Http\Controllers\ExportController::class, 'absensi'])
            ->name('absensi.export');
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

        // Export Keuangan
        Route::get('/dashboard/keuangan/export', [\App\Http\Controllers\ExportController::class, 'keuangan'])
            ->name('keuangan.export');
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

        // Route untuk upload gambar di CKEditor
        Route::post('/dashboard/pengumuman/upload-image', function (\Illuminate\Http\Request $request) {
            if ($request->hasFile('upload')) {
                $file = $request->file('upload');
                $path = $file->store('pengumuman/editor', 'public');
                return response()->json([
                    'url' => asset('storage/' . $path)
                ]);
            }
        })->name('pengumuman.upload-image');
    });

    // ===== Role & Permission (Super Admin saja) =====
    Route::middleware(['role:super_admin'])->group(function () {
        Route::get('/dashboard/role-permission', function () {
            return view('pages.role-permission');
        })->name('role-permission.index');
    });

    // ===== View-only untuk Member =====
    Route::middleware(['role:member'])->group(function () {
        Route::get('/dashboard/riwayat-absensi', function () {
            return view('pages.riwayat-absensi');
        })->name('riwayat-absensi.index');

        Route::get('/dashboard/riwayat-pembayaran', function () {
            return view('pages.riwayat-pembayaran');
        })->name('riwayat-pembayaran.index');
    });

    // ===== Member Profile & Settings (Semua authenticated user) =====
    Route::get('/dashboard/profile', function () {
        return view('pages.member-profile');
    })->name('member.profile');

    Route::get('/dashboard/settings', function () {
        return view('pages.member-settings');
    })->name('member.settings');

    Route::get('/dashboard/kegiatan-saya', function () {
        return view('pages.member-kegiatan-saya');
    })->name('member.kegiatan-saya');
});

Route::middleware(['auth'])->group(function () {
    Route::view('/profile', 'profile')->name('profile');
    Route::view('/settings', 'pages.member-settings')->name('settings');
});

require __DIR__ . '/auth.php';

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');
