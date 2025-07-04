<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class TestAdminLogin extends Command
{
    protected $signature = 'test:admin-login';
    protected $description = 'Test admin login credentials';

    public function handle()
    {
        $this->info('Testing admin login...');
        
        // Check if admin exists
        $admin = Admin::where('email', 'admin@gmail.com')->first();
        
        if (!$admin) {
            $this->error('Admin not found!');
            return;
        }
        
        $this->info('Admin found:');
        $this->line('ID: ' . $admin->id);
        $this->line('Email: ' . $admin->email);
        $this->line('Username: ' . $admin->username);
        $this->line('Full Name: ' . $admin->full_name);
        $this->line('Status: ' . $admin->status);
        
        // Test password
        $password = 'admin123';
        if (Hash::check($password, $admin->password)) {
            $this->info('✅ Password check: SUCCESS');
        } else {
            $this->error('❌ Password check: FAILED');
            
            // Create new admin with correct password
            $this->info('Creating new admin account...');
            
            Admin::where('email', 'admin@gmail.com')->delete();
            
            $newAdmin = Admin::create([
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'full_name' => 'System Administrator',
                'phone' => '081234567890',
                'address' => 'Jakarta, Indonesia',
                'role' => 'SUPER_ADMIN',
                'status' => 'ACTIVE',
            ]);
            
            $this->info('✅ New admin created with ID: ' . $newAdmin->id);
        }
        
        return 0;
    }
}
