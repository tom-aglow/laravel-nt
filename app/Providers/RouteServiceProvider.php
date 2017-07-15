<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        Route::pattern('id', '[0-9]+');

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapImageRoutes();

        $this->mapFileRoutes();

//        $this->mapAdminRoutes();

        $this->mapAdminCPRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
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
     * Define the "Admin" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::middleware(['web', 'admin'])
            ->prefix('admin')
            ->namespace($this->namespace . '\Admin')
            ->group(base_path('routes/admin.php'));
    }

    /**
     * Define the "AdminCP" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapAdminCPRoutes()
    {
        Route::middleware(['api'])
            ->prefix('admincp')
            ->namespace($this->namespace . '\AdminCP')
            ->group(base_path('routes/admincp.php'));
    }

    /**
     * Define the "image" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapImageRoutes()
    {
        Route::prefix('image')
            ->namespace($this->namespace)
            ->group(base_path('routes/image.php'));
    }

    /**
     * Define the "file" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapFileRoutes()
    {
        Route::prefix('file')
            ->namespace($this->namespace)
            ->group(base_path('routes/file.php'));
    }
}
