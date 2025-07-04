<?php

require_once 'vendor/autoload.php';
require_once 'bootstrap/app.php';

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "=== CREATING CUSTOMER USER ===\n";

try {
    // Cek apakah user dengan email aci@gmail.com sudah ada
    $existingUser = User::where('email', 'aci@gmail.com')->first();
    
    if ($existingUser) {
        echo "User with email 'aci@gmail.com' already exists!\n";
        echo "Name: {$existingUser->name}\n";
        echo "Email: {$existingUser->email}\n";
        echo "Created: {$existingUser->created_at}\n";
        
        // Update password to known value
        $existingUser->password = Hash::make('password123');
        $existingUser->save();
        echo "✅ Password updated to 'password123'\n";
    } else {
        // Buat user baru
        $user = User::create([
            'name' => 'Aci Customer',
            'email' => 'aci@gmail.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
        
        echo "✅ Customer user created successfully!\n";
        echo "Email: aci@gmail.com\n";
        echo "Password: password123\n";
    }
    
    // Tampilkan semua users yang ada
    echo "\n=== ALL USERS IN DATABASE ===\n";
    $users = User::all();
    foreach ($users as $user) {
        echo "- {$user->name} ({$user->email})\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}
