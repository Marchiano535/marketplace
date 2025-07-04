<?php

// Simple test script to check controllers
echo "Testing Controllers...\n";

// Test 1: AdminController
try {
    require_once 'vendor/autoload.php';
    $adminController = new \App\Http\Controllers\Admin\AdminController();
    echo "✅ AdminController - OK\n";
} catch (Exception $e) {
    echo "❌ AdminController Error: " . $e->getMessage() . "\n";
}

// Test 2: CartController  
try {
    $cartController = new \App\Http\Controllers\Customer\CartController();
    echo "✅ CartController - OK\n";
} catch (Exception $e) {
    echo "❌ CartController Error: " . $e->getMessage() . "\n";
}

// Test 3: OrderController
try {
    $orderController = new \App\Http\Controllers\Customer\OrderController();
    echo "✅ OrderController - OK\n";
} catch (Exception $e) {
    echo "❌ OrderController Error: " . $e->getMessage() . "\n";
}

echo "Test completed.\n";
