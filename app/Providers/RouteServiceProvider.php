<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers';


    public function boot()
    {
        Route::pattern('id', '[0-9]+');

        parent::boot();

    }

    /**
     * Define the routes for the application.
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapImageRoutes();
        $this->mapFileRoutes();
        $this->mapAdminRoutes();
        $this->mapAdminCPRoutes();
        $this->mapWebRoutes();

        //
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

    protected function mapAdminRoutes()
    {
        Route::middleware(['web', 'admin'])
            ->prefix('admin')
            ->namespace($this->namespace . '\Admin')
            ->group(base_path('routes/admin.php'));
    }

    protected function mapAdminCPRoutes()
    {
        Route::middleware(['api'])
            ->prefix('admincp')
            ->namespace($this->namespace . '\AdminCP')
            ->group(base_path('routes/admincp.php'));
    }

    protected function mapImageRoutes()
    {
        Route::prefix('image')
            ->namespace($this->namespace)
            ->group(base_path('routes/image.php'));
    }

    protected function mapFileRoutes()
    {
        Route::prefix('file')
            ->namespace($this->namespace)
            ->group(base_path('routes/file.php'));
    }
}
