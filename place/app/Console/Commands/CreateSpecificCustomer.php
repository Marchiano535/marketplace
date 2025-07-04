<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateSpecificCustomer extends Command
{
    protected $signature = 'make:customer-aci';
    protected $description = 'Create customer with aci@gmail.com';

    public function handle()
    {
        $this->info('Creating customer with aci@gmail.com...');
        
        try {
            // Cek apakah user sudah ada
            $existingUser = User::where('email', 'aci@gmail.com')->first();
            
            if ($existingUser) {
                $this->info('User already exists, updating password...');
                $existingUser->password = Hash::make('password123');
                $existingUser->save();
                $this->info('✅ Password updated for aci@gmail.com');
            } else {
                // Buat user baru
                $user = User::create([
                    'username' => 'aci',
                    'name' => 'Aci Customer',
                    'full_name' => 'Aci Customer Full Name',
                    'email' => 'aci@gmail.com',
                    'password' => Hash::make('password123'),
                    'email_verified_at' => now(),
                    'phone' => '081234567890',
                    'address' => 'Indonesia',
                    'role' => 'CUSTOMER',
                    'status' => 'ACTIVE',
                    'rating' => 5,
                ]);
                $this->info('✅ Customer created: aci@gmail.com');
            }
            
            $this->info('Login credentials:');
            $this->info('Email: aci@gmail.com');
            $this->info('Password: password123');
            
            // Tampilkan semua users
            $this->info('');
            $this->info('All users in database:');
            $users = User::all();
            foreach ($users as $user) {
                $this->line("- {$user->name} ({$user->email})");
            }
            
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
        }
    }
}
