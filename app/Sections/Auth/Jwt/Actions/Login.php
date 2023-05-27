<?php

namespace Sections\Auth\Jwt\Actions;

use Core\Parents\BaseAction;
use Illuminate\Support\Facades\Auth;
use Sections\Auth\Jwt\Dto\LoginDto;

class Login extends BaseAction
{
    public function run(LoginDto $dto): string|false
    {
        $token = Auth::attempt([
            'email'    => $dto->email,
            'password' => $dto->password,
        ], $dto->remember);
        return $token ?: false;
    }
}
