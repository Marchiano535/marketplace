<?php

require_once 'vendor/autoload.php';
require_once 'bootstrap/app.php';

use App\Models\User;
use App\Models\Admin;

echo "=== CHECKING DATABASE USERS ===\n";

try {
    $users = User::all();
    echo "Total Users: " . $users->count() . "\n\n";
    
    foreach ($users as $user) {
        echo "ID: {$user->id}\n";
        echo "Name: {$user->name}\n";
        echo "Email: {$user->email}\n";
        echo "Created: {$user->created_at}\n";
        echo "---\n";
    }
    
    echo "\n=== CHECKING ADMIN USERS ===\n";
    $admins = Admin::all();
    echo "Total Admins: " . $admins->count() . "\n\n";
    
    foreach ($admins as $admin) {
        echo "ID: {$admin->id}\n";
        echo "Name: {$admin->name}\n";
        echo "Email: {$admin->email}\n";
        echo "Created: {$admin->created_at}\n";
        echo "---\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
