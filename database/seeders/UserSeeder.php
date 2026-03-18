<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();

        // Admin account
        User::updateOrCreate(
            ['email' => 'admin@cameramam.com'],
            [
                'name' => 'Admin CameraMan',
                'password' => Hash::make('admin123'),
                'phone' => '0901234567',
                'role_id' => $adminRole->id,
                'status' => 'active',
            ]
        );

        // User account
        User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Nguyễn Văn A',
                'password' => Hash::make('user123'),
                'phone' => '0912345678',
                'birthday' => '1995-05-15',
                'role_id' => $userRole->id,
                'status' => 'active',
            ]
        );
    }
}
