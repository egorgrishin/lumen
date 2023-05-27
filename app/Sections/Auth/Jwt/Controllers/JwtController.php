<?php

namespace Sections\Auth\Jwt\Controllers;

use Core\Parents\BaseController;
use Illuminate\Http\JsonResponse;
use Sections\Auth\Jwt\Actions\CheckAuth;
use Sections\Auth\Jwt\Actions\Login;
use Sections\Auth\Jwt\Requests\LoginRequest;

class JwtController extends BaseController
{
    /**
     * Авторизация
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $token = $this->action(Login::class)->run(
            $request->toDto()
        );

        return $token
            ? response()->json(['jwt_token' => $token])
            : response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Проверка авторизации
     */
    public function check(): JsonResponse
    {
        return response()->json([
            'status' => $this->action(CheckAuth::class)->run(),
        ]);
    }
}
