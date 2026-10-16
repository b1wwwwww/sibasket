<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Anggota;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user (already exists via AdminUserSeeder, but let's be safe)
        $admin = User::firstOrCreate(
            ['email' => 'admin@sibasket.test'],
            ['name' => 'Admin User', 'password' => Hash::make('password')]
        );
        $admin->assignRole('admin');

        // Pembina user
        $pembina = User::firstOrCreate(
            ['email' => 'pembina@sibasket.test'],
            ['name' => 'Pembina User', 'password' => Hash::make('password')]
        );
        $pembina->assignRole('pembina');

        // Member user
        $member = User::firstOrCreate(
            ['email' => 'member@sibasket.test'],
            ['name' => 'Member User', 'password' => Hash::make('password')]
        );
        $member->assignRole('member');
        
        // Link member to an Anggota record (required for some dashboard metrics)
        Anggota::firstOrCreate(
            ['user_id' => $member->id],
            [
                'nis' => 'TEST001',
                'nama' => 'Member User',
                'kelas' => '10A',
                'jurusan' => 'pplg',
                'status' => 'aktif',
                'tanggal_bergabung' => now()
            ]
        );
    }
}
