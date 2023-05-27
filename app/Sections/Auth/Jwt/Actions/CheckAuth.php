<?php

namespace Sections\Auth\Jwt\Actions;

use Core\Parents\BaseAction;
use Illuminate\Support\Facades\Auth;

class CheckAuth extends BaseAction
{
    /**
     * Проверяет авторизацию пользователя
     */
    public function run(): bool
    {
        return Auth::check();
    }
}
