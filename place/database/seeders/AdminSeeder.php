<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the requested admin account
        Admin::create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'full_name' => 'System Administrator',
            'phone' => '081234567890',
            'address' => 'Jakarta, Indonesia',
            'role' => 'SUPER_ADMIN',
            'status' => 'ACTIVE',
        ]);

        // Create another admin for testing
        Admin::create([
            'username' => 'admintest',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'full_name' => 'Test Administrator',
            'phone' => '081234567891',
            'address' => 'Bandung, Indonesia',
            'role' => 'ADMIN',
            'status' => 'ACTIVE',
        ]);
    }
}
