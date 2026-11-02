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

    protected function canAccess(string $permission): bool
    {
        $user = Auth::user();

        if (!$user) {
            return false;
        }

        if (!class_exists(\Spatie\Permission\Models\Permission::class)) {
            return false;
        }

        $permissionExists = \Spatie\Permission\Models\Permission::where('name', $permission)
            ->where('guard_name', 'web')
            ->exists();

        if (!$permissionExists) {
            return false;
        }

        try {
            return $user->can($permission);
        } catch (\Throwable $e) {
            return false;
        }
    }

    public function getMenuItems(): array
    {
        $user = Auth::user();
        $items = [];

        // Jika tidak ada user (public pages), return empty
        if (!$user) {
            return $items;
        }

        // Always include Dashboard
        $items[] = [
            'label' => 'Dashboard',
            'route' => 'dashboard',
            'icon' => 'home',
        ];

        // ========== MEMBER-ONLY MENU (Early Return) ==========
        // BUG FIX: Member tidak boleh lihat menu admin
        if ($user->hasRole('member')) {
            $items[] = [
                'label' => 'Kegiatan Saya',
                'route' => 'member.kegiatan-saya',
                'icon' => 'calendar',
            ];
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
            $items[] = [
                'label' => 'Profil Saya',
                'route' => 'member.profile',
                'icon' => 'user',
            ];

            // Kalau dia HANYA member (bukan admin), kembalikan langsung
            if (!$user->hasRole('admin') && !$user->hasRole('super_admin') && !$user->hasRole('pembina')) {
                return $items; 
            }
        }

        // ========== ADMIN/SUPER_ADMIN/PEMBINA MENU ==========

        // Anggota (Admin permissions)
        if ($this->canAccess('view anggota')) {
            $items[] = [
                'label' => 'Daftar Anggota',
                'route' => 'anggota.index',
                'icon' => 'users',
            ];

            // NEW: Pendaftar Baru (approval flow)
            $items[] = [
                'label' => 'Pendaftar Baru',
                'route' => 'pendaftar-baru.index',
                'icon' => 'user-plus',
            ];
        }

        // Kegiatan (Admin permissions)
        if ($this->canAccess('view kegiatan')) {
            $items[] = [
                'label' => 'Kegiatan',
                'route' => 'kegiatan.index',
                'icon' => 'calendar',
            ];
        }

        // Pendaftaran Kegiatan
        if ($this->canAccess('view pendaftaran_kegiatan')) {
            $items[] = [
                'label' => 'Pendaftaran Kegiatan',
                'route' => 'pendaftaran-kegiatan.index',
                'icon' => 'clipboard',
            ];
        }

        // Absensi
        if ($this->canAccess('view absensi')) {
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
        if ($this->canAccess('view keuangan')) {
            $items[] = [
                'label' => 'Keuangan',
                'route' => 'keuangan.index',
                'icon' => 'credit-card',
            ];
        }

        // Pengumuman
        if ($this->canAccess('view pengumuman')) {
            $items[] = [
                'label' => 'Pengumuman',
                'route' => 'pengumuman.index',
                'icon' => 'bell',
            ];
        }

        // Role & Permission (Super Admin only)
        if ($user->hasRole('super_admin')) {
            $items[] = [
                'label' => 'Role & Permission',
                'route' => 'role-permission.index',
                'icon' => 'lock',
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
