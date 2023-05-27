<?php

namespace Sections\Auth\Jwt\Requests;

use Core\Parents\BaseRequest;
use Sections\Auth\Jwt\Dto\LoginDto;

class LoginRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'email'    => 'required|email',
            'password' => 'required|string',
            'remember' => 'required|boolean',
        ];
    }

    public function toDto(): LoginDto
    {
        return LoginDto::fromRequest($this);
    }
}
