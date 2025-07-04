<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('production')) {
            $this->app->bind('path.public', function() {
                return realpath(base_path('../public_html'));
            });
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Disable lazy loading in production to prevent N+1 queries
        Model::preventLazyLoading(! $this->app->isProduction());

        // Use Bootstrap for pagination
        Paginator::useBootstrap();

        // Enable query caching in production
        if ($this->app->environment('production')) {
            \DB::enableQueryLog();
        }
    }
}
