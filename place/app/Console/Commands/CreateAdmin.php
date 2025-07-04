<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    protected $signature = 'create:admin';
    protected $description = 'Create admin account';

    public function handle()
    {
        $this->info('Creating admin account...');
        
        // Delete existing admin if exists
        Admin::where('email', 'admin@gmail.com')->delete();
        
        // Create new admin
        $admin = Admin::create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'full_name' => 'System Administrator',
            'phone' => '081234567890',
            'address' => 'Jakarta, Indonesia',
            'role' => 'SUPER_ADMIN',
            'status' => 'ACTIVE',
        ]);
        
        $this->info('✅ Admin created successfully!');
        $this->line('Email: admin@gmail.com');
        $this->line('Password: admin123');
        $this->line('ID: ' . $admin->id);
        
        return 0;
    }
}
