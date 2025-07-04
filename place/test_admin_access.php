<?php

require_once 'vendor/autoload.php';

use Illuminate\Foundation\Application;

$app = require_once 'bootstrap/app.php';

try {
    // Test if AdminController can be instantiated
    $controller = new \App\Http\Controllers\Admin\AdminController();
    echo "✅ AdminController instantiated successfully\n";
    
    // Test if methods exist
    if (method_exists($controller, 'dashboard')) {
        echo "✅ dashboard() method exists\n";
    } else {
        echo "❌ dashboard() method missing\n";
    }
    
    if (method_exists($controller, 'products')) {
        echo "✅ products() method exists\n";
    } else {
        echo "❌ products() method missing\n";
    }
    
    if (method_exists($controller, 'orders')) {
        echo "✅ orders() method exists\n";
    } else {
        echo "❌ orders() method missing\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
}
