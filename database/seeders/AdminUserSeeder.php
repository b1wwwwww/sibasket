<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Super Admin "Nabil"
        $admin = User::firstOrCreate(
            ['email' => 'nabilyusr4@gmail.com'],
            [
                'name' => 'Nabil',
                'password' => Hash::make('password123'),
            ]
        );

        // Assign role super_admin jika belum punya
        if (!$admin->hasRole('super_admin')) {
            $admin->assignRole('super_admin');
        }

        echo "✓ Admin user '{$admin->name}' ({$admin->email}) sudah siap. Password: password123\n";
    }
}
