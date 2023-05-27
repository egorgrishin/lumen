<?php

namespace Core\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Laravel\Lumen\Routing\Router;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->setModuleRoutes();
    }

    /**
     * Определяет маршрутизацию модулей
     */
    private function setModuleRoutes(): void
    {
        $dir = __DIR__;
        collect(glob("$dir/../../Sections/*/*/Routes/routes.php"))
            ->map(fn (string $route) => realpath($route))
            ->each(function (string $route) {
                Route::group(
                    ['prefix' => 'api/v1', 'middleware' => 'throttle:60,1'],
                    fn (Router $router) => require $route,
                );
            });
    }
}
