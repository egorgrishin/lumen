<?php

namespace Sections\Auth\Jwt\Dto;

use Core\Helpers\Dto\Constructable;
use Core\Parents\BaseDto;
use Sections\Auth\Jwt\Requests\LoginRequest;

readonly class LoginDto extends BaseDto
{
    use Constructable;

    public string $email;
    public string $password;
    public bool   $remember;

    public static function fromRequest(LoginRequest $request): self
    {
        return new self($request->safe()->toArray());
    }
}
