<?php

require_once 'bootstrap/app.php';

echo "Testing after Controller fix...\n";

try {
    $controller = new \App\Http\Controllers\Admin\AdminController();
    echo "✅ AdminController instantiated successfully\n";
    
    $cartController = new \App\Http\Controllers\Customer\CartController();
    echo "✅ CartController instantiated successfully\n";
    
    $orderController = new \App\Http\Controllers\Customer\OrderController();
    echo "✅ OrderController instantiated successfully\n";
    
    echo "✅ All controllers working!\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}
