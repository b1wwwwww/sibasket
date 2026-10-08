<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Sidebar extends Component
{
    public bool $open = false;

    public function toggleSidebar(): void
    {
        $this->open = !$this->open;
    }

    public function getMenuItems(): array
    {
        $user = Auth::user();
        $items = [];

        // Always include Dashboard
        $items[] = [
            'label' => 'Dashboard',
            'route' => 'dashboard',
            'icon' => 'home',
        ];

        // Anggota (Admin permissions)
        if ($user->can('view anggota')) {
            $items[] = [
                'label' => 'Daftar Anggota',
                'route' => 'anggota.index',
                'icon' => 'users',
            ];
        }

        // Kegiatan (Admin permissions)
        if ($user->can('view kegiatan')) {
            $items[] = [
                'label' => 'Kegiatan',
                'route' => 'kegiatan.index',
                'icon' => 'calendar',
            ];
        }

        // Pendaftaran Kegiatan
        if ($user->can('view pendaftaran_kegiatan')) {
            $items[] = [
                'label' => 'Pendaftaran Kegiatan',
                'route' => 'pendaftaran-kegiatan.index',
                'icon' => 'clipboard',
            ];
        }

        // Absensi
        if ($user->can('view absensi')) {
            $items[] = [
                'label' => 'Absensi',
                'route' => 'absensi.index',
                'icon' => 'check-square',
                'submenu' => [
                    ['label' => 'Input Absensi', 'route' => 'absensi.index'],
                    ['label' => 'Recap Absensi', 'route' => 'recap-absensi.index'],
                ],
            ];
        }

        // Keuangan
        if ($user->can('view keuangan')) {
            $items[] = [
                'label' => 'Keuangan',
                'route' => 'keuangan.index',
                'icon' => 'credit-card',
            ];
        }

        // Pengumuman
        if ($user->can('view pengumuman')) {
            $items[] = [
                'label' => 'Pengumuman',
                'route' => 'pengumuman.index',
                'icon' => 'bell',
            ];
        }

        // Role & Permission (Super Admin only)
        if ($user->hasRole('Super Admin')) {
            $items[] = [
                'label' => 'Role & Permission',
                'route' => 'role-permission.index',
                'icon' => 'lock',
            ];
        }

        // Member view-only items
        if ($user->hasRole('Member')) {
            $items[] = [
                'label' => 'Riwayat Absensi',
                'route' => 'riwayat-absensi.index',
                'icon' => 'history',
            ];
            $items[] = [
                'label' => 'Riwayat Pembayaran',
                'route' => 'riwayat-pembayaran.index',
                'icon' => 'file-text',
            ];
        }

        return $items;
    }

    public function render()
    {
        return view('livewire.sidebar', [
            'menuItems' => $this->getMenuItems(),
        ]);
    }
}
