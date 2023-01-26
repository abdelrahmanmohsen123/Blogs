<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers';
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard/home';



    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {


        $this->mapApiRoutes();


        $this->mapWebRoutes();

        
        $this->mapAdminRoutes();


       
    }
   
    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */

    public function boot()
    {
        parent::boot();
        $this->configureRateLimiting();

        
    }
    protected function mapAdminRoutes()
    {
        Route::prefix('admin')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin.php'));
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->prefix('dashboard')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }



    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
