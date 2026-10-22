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

        // ===== CREATE ROLES (5 ROLES ONLY) =====
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $ketuaRole = Role::firstOrCreate(['name' => 'ketua', 'guard_name' => 'web']);
        $bendaharaRole = Role::firstOrCreate(['name' => 'bendahara', 'guard_name' => 'web']);
        $absensiRole = Role::firstOrCreate(['name' => 'absensi', 'guard_name' => 'web']); // Absensi/Sekretaris
        $peminaRole = Role::firstOrCreate(['name' => 'pembina', 'guard_name' => 'web']);
        $memberRole = Role::firstOrCreate(['name' => 'member', 'guard_name' => 'web']);

        // ===== ASSIGN PERMISSIONS TO SUPER ADMIN =====
        $superAdminRole->syncPermissions($permissions);

        // ===== ASSIGN PERMISSIONS TO KETUA =====
        $ketuaPermissions = [
            'view anggota', 'create anggota', 'update anggota', 'delete anggota',
            'view kegiatan', 'create kegiatan', 'update kegiatan', 'delete kegiatan',
            'view pendaftaran_kegiatan', 'create pendaftaran_kegiatan', 'update pendaftaran_kegiatan', 'delete pendaftaran_kegiatan',
            'view pengumuman', 'create pengumuman', 'update pengumuman', 'delete pengumuman',
            'view laporan',
        ];
        $ketuaRole->syncPermissions($ketuaPermissions);

        // ===== ASSIGN PERMISSIONS TO BENDAHARA =====
        $bendaharaPermissions = [
            'view anggota', 'create anggota', 'update anggota', 'delete anggota',
            'view keuangan', 'create keuangan', 'update keuangan', 'delete keuangan',
            'view pengumuman', 'create pengumuman', 'update pengumuman', 'delete pengumuman',
            'view laporan',
        ];
        $bendaharaRole->syncPermissions($bendaharaPermissions);

        // ===== ASSIGN PERMISSIONS TO ABSENSI/SEKRETARIS =====
        $absensiPermissions = [
            'view anggota', 'create anggota', 'update anggota', 'delete anggota',
            'view kegiatan', 'create kegiatan', 'update kegiatan', 'delete kegiatan',
            'view pendaftaran_kegiatan', 'create pendaftaran_kegiatan', 'update pendaftaran_kegiatan', 'delete pendaftaran_kegiatan',
            'view absensi', 'create absensi', 'update absensi', 'delete absensi',
            'view pengumuman', 'create pengumuman', 'update pengumuman', 'delete pengumuman',
            'view laporan',
        ];
        $absensiRole->syncPermissions($absensiPermissions);

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
