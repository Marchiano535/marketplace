<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateCustomer extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'make:customer {email} {password}';

    /**
     * The console command description.
     */
    protected $description = 'Create a new customer user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');

        // Check if user already exists
        if (User::where('email', $email)->exists()) {
            $this->error("Customer with email {$email} already exists!");
            return 1;
        }

        $user = User::create([
            'username' => explode('@', $email)[0],
            'name' => 'Customer',
            'full_name' => 'Customer User',
            'email' => $email,
            'email_verified_at' => now(),
            'password' => Hash::make($password),
            'phone' => '081234567890',
            'address' => 'Indonesia',
            'role' => 'CUSTOMER',
            'status' => 'ACTIVE',
            'rating' => 5,
        ]);

        $this->info("Customer created successfully!");
        $this->info("Email: {$user->email}");
        $this->info("Password: {$password}");
        $this->info("Username: {$user->username}");

        return 0;
    }
}
