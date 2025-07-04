<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Console\Command;

class TestAdminController extends Command
{
    protected $signature = 'test:admin-controller';
    protected $description = 'Test admin controller';

    public function handle()
    {
        $this->info('Testing AdminController...');
        
        try {
            // Create controller instance
            $controller = new AdminController();
            $this->info('✅ AdminController instantiated successfully');
            
            // Check if methods exist
            $methods = ['dashboard', 'products', 'orders'];
            foreach ($methods as $method) {
                if (method_exists($controller, $method)) {
                    $this->info("✅ Method {$method}() exists");
                } else {
                    $this->error("❌ Method {$method}() not found");
                }
            }
            
        } catch (\Exception $e) {
            $this->error('❌ Error: ' . $e->getMessage());
        }
        
        return 0;
    }
}
