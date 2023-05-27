<?php

namespace Sections\User\User\Requests;

use Core\Parents\BaseRequest;
use Sections\User\User\Dto\FindUserDto;

class FindUserRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'fields'   => 'nullable|array',
            'fields.*' => 'nullable|distinct|string',
        ];
    }

    public function toDto(): FindUserDto
    {
        return FindUserDto::fromRequest($this);
    }
}
