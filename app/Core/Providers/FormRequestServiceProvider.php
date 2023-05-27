<?php

namespace Core\Providers;

use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Core\Parents\BaseRequest;
use Illuminate\Support\ServiceProvider;

class FormRequestServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->app->afterResolving(ValidatesWhenResolved::class, function ($resolved) {
            $resolved->validateResolved();
        });

        $this->app->resolving(BaseRequest::class, function ($request, $app) {
            $request = BaseRequest::createFrom($app['request'], $request);
            $request->setContainer($app);
        });
    }
}
