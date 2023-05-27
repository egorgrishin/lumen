<?php

namespace Sections\User\User\Dto;

use Core\Helpers\Dto\Constructable;
use Core\Parents\BaseDto;
use Sections\User\User\Requests\CreateUserRequest;

readonly class CreateUserDto extends BaseDto
{
    use Constructable;

    public ?string $name;
    public ?string $email;
    public ?string $password;

    public static function fromRequest(CreateUserRequest $request): self
    {
        return new self([
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'password' => $request->input('password'),
        ]);
    }
}
