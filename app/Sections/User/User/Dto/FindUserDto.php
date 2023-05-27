<?php

namespace Sections\User\User\Dto;

use Core\Helpers\Dto\Constructable;
use Core\Parents\BaseDto;
use Sections\User\User\Requests\FindUserRequest;

readonly class FindUserDto extends BaseDto
{
    use Constructable;

    public int   $id;
    public array $fields;

    public static function fromRequest(FindUserRequest $request): self
    {
        return new self([
            'id'     => $request->route('user_id'),
            'fields' => $request->input('fields', ['*']),
        ]);
    }
}
