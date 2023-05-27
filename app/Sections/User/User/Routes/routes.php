<?php

/** @var Laravel\Lumen\Routing\Router $router */
use Sections\User\User\Controllers\UserController;

$router->group([
    'prefix' => 'users',
], function () use ($router) {
    $router->get('/', route_action([UserController::class, 'get']));
    $router->post('/', route_action([UserController::class, 'create']));
    $router->get('/{user_id}', route_action([UserController::class, 'find']));
    $router->patch('/{user_id}', route_action([UserController::class, 'update']));
});
