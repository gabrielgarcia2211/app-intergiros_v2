<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = 'sites/welcome';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Route::middleware('web')
            //     ->group(base_path('routes/web.php'));
        });

        $files_routes = scandir(base_path('routes/web'));

        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(function () use ($files_routes) {
                require base_path('routes/web.php');
                foreach ($files_routes as $file_route) {
                    if (str_contains($file_route, '.php') && file_exists(base_path('routes/web/' . $file_route))) {
                        require base_path('routes/web/' . $file_route);
                    }
                }
            });
    }
}