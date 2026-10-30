<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Log;

class PublicPageController extends Controller
{
    /**
     * Halaman utama (Home)
     */
    public function home()
    {
        try {
            $kegiatan = Kegiatan::whereIn('status', ['published', 'ongoing'])
                ->orderBy('tanggal', 'asc')
                ->take(4)
                ->get();

            $pengumuman = Pengumuman::where('status', 'published')
                ->orderByDesc('is_pinned')
                ->orderByDesc('tanggal_publish')
                ->take(4)
                ->get();
        } catch (\Throwable $e) {
            Log::error('Error loading home page data', ['error' => $e->getMessage()]);
            $kegiatan = collect();
            $pengumuman = collect();
        }

        return view('pages.home', compact('kegiatan', 'pengumuman'));
    }

    /**
     * Daftar kegiatan publik (list page)
     */
    public function kegiatanPublik()
    {
        return view('pages.kegiatan-publik');
    }

    /**
     * Detail kegiatan publik
     */
    public function kegiatanDetail($id)
    {
        return view('pages.kegiatan-detail', ['id' => $id]);
    }

    /**
     * Daftar pengumuman publik (list page)
     */
    public function pengumumanPublik()
    {
        return view('pages.pengumuman-publik');
    }

    /**
     * Detail pengumuman publik
     */
    public function pengumumanDetail($id)
    {
        return view('pages.pengumuman-detail', ['id' => $id]);
    }

    /**
     * Halaman daftar anggota
     */
    public function daftarAnggota()
    {
        return view('pages.daftar-anggota');
    }

    /**
     * Gallery (index)
     */
    public function galleryIndex()
    {
        return view('pages.gallery');
    }

    /**
     * Gallery detail
     */
    public function galleryShow($id)
    {
        return view('pages.gallery-detail', ['id' => $id]);
    }

    /**
     * Setup admin akun (hanya di development)
     * Route ini protected dengan middleware 'local' di routes/web.php
     */
    public function setupAdminTemp()
    {
        // Pastikan package Spatie role/permission tersedia
        if (!class_exists(\Spatie\Permission\Models\Role::class)) {
            return 'Package Spatie Permission tidak ditemukan.';
        }

        // 1. Buat Roles jika belum ada
        $superAdminRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'super_admin']);
        $adminRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin']);
        $pembinaRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'pembina']);
        $memberRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'member']);

        // 2. Buat Akun dan Assign Role-nya masing-masing
        $accounts = [
            [
                'name' => 'Super Admin SIBASKET',
                'email' => 'nabilyusr4@gmail.com',
                'password' => \Illuminate\Support\Facades\Hash::make('password123'),
                'role' => $superAdminRole
            ],
            [
                'name' => 'Admin SIBASKET',
                'email' => 'admin@sibasket.test',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => $adminRole
            ],
            [
                'name' => 'Pembina SIBASKET',
                'email' => 'pembina@sibasket.test',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => $pembinaRole
            ],
            [
                'name' => 'Member SIBASKET',
                'email' => 'member@sibasket.test',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => $memberRole
            ],
        ];

        foreach ($accounts as $acc) {
            $user = \App\Models\User::firstOrCreate(
                ['email' => $acc['email']],
                [
                    'name' => $acc['name'],
                    'password' => $acc['password']
                ]
            );
            
            // Berikan role ke user
            $user->assignRole($acc['role']);
        }

        Log::info('Setup admin akun berhasil dijalankan di development environment');
        return 'Semua akun dan role berhasil di-setup! Silakan hapus route ini sebelum go-live.';
    }
}
