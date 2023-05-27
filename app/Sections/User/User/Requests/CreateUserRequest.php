<?php

namespace Sections\User\User\Requests;

use Core\Parents\BaseRequest;
use Sections\User\User\Dto\CreateUserDto;
use Sections\User\User\Models\User;

class CreateUserRequest extends BaseRequest
{
    public function rules(): array
    {
        $class_string = User::class;

        return [
            'name'     => 'required|string',
            'email'    => "required|email|unique:$class_string,email",
            'password' => 'required|string',
        ];
    }

    public function toDto(): CreateUserDto
    {
        return CreateUserDto::fromRequest($this);
    }
}
