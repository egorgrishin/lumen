<?php

namespace Sections\Auth\Jwt\Tests;

use Core\Parents\BaseTest;
use Sections\User\User\Models\User;

class AuthTest extends BaseTest
{
    public function testLogin()
    {
        $this->post('api/v1/auth/login', [
            'email'    => 'test@mail.ru',
            'password' => 'test',
        ])->seeStatusCode(422);

        $email = User::query()->select('email')->first()->email;
        $this->post('api/v1/auth/login', [
            'email'    => $email,
            'password' => 'QWERTY',
            'remember' => true,
        ])->seeStatusCode(401);

        $this->post('api/v1/auth/login', [
            'email'    => $email,
            'password' => 'password',
            'remember' => true,
        ])
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'jwt_token',
            ]);
    }
}
