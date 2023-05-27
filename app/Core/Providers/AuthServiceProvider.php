<?php

namespace Core\Providers;

use Illuminate\Support\ServiceProvider;
use Sections\Auth\Jwt\JwtGuard;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     */
    public function boot(): void
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->extend('jwt', function ($app, $name, array $config) {
            $guard = new JwtGuard(
                $app->auth->createUserProvider($config['provider']),
                $app->request
            );
            $app->refresh('request', $guard, 'setRequest');

            return $guard;
        });
    }
}
