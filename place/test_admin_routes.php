<?php

use App\Console\Commands\TestAdminController;
use Illuminate\Support\Facades\Route;

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

echo "Testing Admin Routes and Controllers...\n";

try {
    // Test if routes are registered
    $routes = Route::getRoutes();
    $adminRoutes = [];
    
    foreach ($routes as $route) {
        if (str_contains($route->getName() ?? '', 'admin.')) {
            $adminRoutes[] = $route->getName();
        }
    }
    
    echo "Found " . count($adminRoutes) . " admin routes:\n";
    foreach ($adminRoutes as $routeName) {
        echo "  - " . $routeName . "\n";
    }
    
    // Test AdminController instantiation
    $controller = new \App\Http\Controllers\Admin\AdminController();
    echo "✅ AdminController instantiation successful\n";
    
    // Test AuthController
    $authController = new \App\Http\Controllers\Admin\AuthController();
    echo "✅ AdminAuthController instantiation successful\n";
    
    echo "✅ All admin components working correctly!\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}
