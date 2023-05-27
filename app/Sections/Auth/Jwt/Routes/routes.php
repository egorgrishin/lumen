<?php

/** @var Laravel\Lumen\Routing\Router $router */
use Sections\Auth\Jwt\Controllers\JwtController;

$router->post('auth/login', route_action([JwtController::class, 'login']));
$router->post('auth/check', route_action([JwtController::class, 'check']));
