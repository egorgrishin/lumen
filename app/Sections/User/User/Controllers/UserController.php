<?php

namespace Sections\User\User\Controllers;

use Core\Parents\BaseController;
use Illuminate\Http\JsonResponse;
use Sections\User\User\Actions\GetUsersAction;
use Sections\User\User\Actions\CreateUserAction;
use Sections\User\User\Actions\FindUserAction;
use Sections\User\User\Actions\UpdateUserAction;
use Sections\User\User\Requests\GetUsersRequest;
use Sections\User\User\Requests\FindUserRequest;
use Sections\User\User\Requests\CreateUserRequest;
use Sections\User\User\Requests\UpdateUserRequest;

class UserController extends BaseController
{
    /**
     * Возвращает список пользователей
     */
    public function get(GetUsersRequest $request): JsonResponse
    {
        $users = $this->action(GetUsersAction::class)->run(
            $request->toDto()
        );

        return response()->json($users);
    }

    /**
     * Возвращает пользователя по ID
     */
    public function find(FindUserRequest $request): JsonResponse
    {
        $user = $this->action(FindUserAction::class)->run(
            $request->toDto()
        );

        return response()->json($user);
    }

    /**
     * Создает пользователя
     */
    public function create(CreateUserRequest $request): JsonResponse
    {
        $user = $this->action(CreateUserAction::class)->run(
            $request->toDto()
        );

        return response()->json($user);
    }

    /**
     * Обновляет пользователя
     */
    public function update(UpdateUserRequest $request): JsonResponse
    {
        $this->action(UpdateUserAction::class)->run(
            $request->toDto()
        );

        return response()->json();
    }
}
