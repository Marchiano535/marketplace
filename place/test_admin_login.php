<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';

// Bootstrap Laravel
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Testing Admin Login Route...\n";

try {
    // Simulate a request to admin login
    $request = \Illuminate\Http\Request::create('/admin/login', 'GET');
    
    // Set up route for testing
    $router = app('router');
    
    // Test if the route exists
    try {
        $route = $router->getRoutes()->match($request);
        echo "✅ Admin login route found: " . $route->getName() . "\n";
        
        // Test controller instantiation
        $controller = new \App\Http\Controllers\Admin\AuthController();
        echo "✅ AuthController instantiated successfully\n";
        
        // Test if method exists
        if (method_exists($controller, 'showLoginForm')) {
            echo "✅ showLoginForm method exists\n";
        }
        
    } catch (Exception $e) {
        echo "❌ Route error: " . $e->getMessage() . "\n";
    }
    
} catch (Exception $e) {
    echo "❌ Bootstrap error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}

echo "Test completed.\n";
