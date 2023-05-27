<?php

namespace Sections\User\User\Requests;

use Core\Parents\BaseRequest;
use Sections\User\User\Dto\GetUsersDto;

class GetUsersRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'fields'       => 'nullable|array',
            'fields.*'     => 'nullable|distinct|string',
            'limit'        => 'nullable|integer',
            'offset'       => 'nullable|integer',
            'sort_by'      => 'required_with:order_by',
            'order_by'     => 'required_with:sort_by|in:asc,desc',
        ];
    }

    public function toDto(): GetUsersDto
    {
        return GetUsersDto::fromRequest($this);
    }
}
