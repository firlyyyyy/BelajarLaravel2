<?php

namespace App\Providers;

// use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\Paginator;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public const HOME = '/home';
    
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    protected $namespace = 'App\\Http\\Controller';
    public function boot(): void
    {
        Paginator::useBootstrap();
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }

    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
