<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // ===== CREATE PERMISSIONS =====
        $permissions = [
            // Anggota
            'view anggota',
            'create anggota',
            'update anggota',
            'delete anggota',

            // Kegiatan
            'view kegiatan',
            'create kegiatan',
            'update kegiatan',
            'delete kegiatan',

            // Pendaftaran Kegiatan
            'view pendaftaran_kegiatan',
            'create pendaftaran_kegiatan',
            'update pendaftaran_kegiatan',
            'delete pendaftaran_kegiatan',

            // Absensi
            'view absensi',
            'create absensi',
            'update absensi',
            'delete absensi',

            // Pengumuman
            'view pengumuman',
            'create pengumuman',
            'update pengumuman',
            'delete pengumuman',

            // Keuangan
            'view keuangan',
            'create keuangan',
            'update keuangan',
            'delete keuangan',

            // Laporan
            'view laporan',

            // Role & Permission
            'manage role_permission',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // ===== CREATE ROLES =====
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $peminaRole = Role::firstOrCreate(['name' => 'pembina', 'guard_name' => 'web']);
        $memberRole = Role::firstOrCreate(['name' => 'member', 'guard_name' => 'web']);

        // ===== ASSIGN PERMISSIONS TO SUPER ADMIN =====
        $superAdminRole->syncPermissions($permissions);

        // ===== ASSIGN PERMISSIONS TO ADMIN =====
        $adminPermissions = [
            'view anggota', 'create anggota', 'update anggota', 'delete anggota',
            'view kegiatan', 'create kegiatan', 'update kegiatan', 'delete kegiatan',
            'view pendaftaran_kegiatan', 'create pendaftaran_kegiatan', 'update pendaftaran_kegiatan', 'delete pendaftaran_kegiatan',
            'view absensi', 'create absensi', 'update absensi', 'delete absensi',
            'view pengumuman', 'create pengumuman', 'update pengumuman', 'delete pengumuman',
            'view keuangan', 'create keuangan', 'update keuangan', 'delete keuangan',
            'view laporan',
        ];
        $adminRole->syncPermissions($adminPermissions);

        // ===== ASSIGN PERMISSIONS TO PEMBINA (VIEW ONLY) =====
        $peminaPermissions = [
            'view anggota',
            'view kegiatan',
            'view pendaftaran_kegiatan',
            'view absensi',
            'view pengumuman',
            'view keuangan',
            'view laporan',
        ];
        $peminaRole->syncPermissions($peminaPermissions);

        // ===== ASSIGN PERMISSIONS TO MEMBER =====
        $memberPermissions = [
            'view kegiatan',
            'create pendaftaran_kegiatan',
            'view pendaftaran_kegiatan',
            'view absensi',
            'view pengumuman',
        ];
        $memberRole->syncPermissions($memberPermissions);

        echo "✓ Seeder role & permission berhasil dijalankan.\n";
    }
}
