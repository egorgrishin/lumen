<?php

namespace Core\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Define your app configuration.
     */
    public function boot(): void
    {
        $this->setMigrationsDirs();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Устанавливает директории для загрузки миграций
     */
    private function setMigrationsDirs(): void
    {
        $dir = __DIR__;
        $paths = glob("$dir/../../Sections/*/*/Data/Migrations");
        $this->loadMigrationsFrom($paths);
    }
}
