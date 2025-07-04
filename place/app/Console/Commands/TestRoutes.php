<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class TestRoutes extends Command
{
    protected $signature = 'test:routes';
    protected $description = 'Test admin routes and middleware';

    public function handle()
    {
        $this->info('Testing Admin Routes...');
        
        // Check if admin routes exist
        $adminRoutes = collect(Route::getRoutes())->filter(function ($route) {
            return str_contains($route->getName() ?? '', 'admin.');
        });
        
        $this->info('Found ' . $adminRoutes->count() . ' admin routes:');
        
        foreach ($adminRoutes as $route) {
            $this->line('- ' . $route->getName() . ' => ' . $route->uri());
        }
        
        // Test middleware
        $adminDashboardRoute = Route::getRoutes()->getByName('admin.dashboard');
        if ($adminDashboardRoute) {
            $middleware = $adminDashboardRoute->gatherMiddleware();
            $this->info('Admin dashboard middleware: ' . implode(', ', $middleware));
        }
        
        return 0;
    }
}
