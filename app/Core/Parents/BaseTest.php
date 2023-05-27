<?php

namespace Core\Parents;

use Laravel\Lumen\Application;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\TestCase as BaseTestCase;

abstract class BaseTest extends BaseTestCase
{
    use DatabaseMigrations;

    public function createApplication(): Application
    {
        return require __DIR__ . '/../../../bootstrap/app.php';
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }
}
