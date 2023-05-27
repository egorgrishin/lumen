<?php

namespace Sections\User\User\Dto;

use Core\Classes\Illuminate\Dto\SortDto;
use Core\Helpers\Dto\Constructable;
use Core\Parents\BaseDto;
use Sections\User\User\Requests\GetUsersRequest;

readonly class GetUsersDto extends BaseDto
{
    use Constructable;

    public array   $fields;
    public int     $limit;
    public int     $offset;
    public SortDto $sort;

    public static function fromRequest(GetUsersRequest $request): self
    {
        return new self([
            'fields' => $request->input('fields', ['*']),
            'offset' => $request->input('offset', 0),
            'limit'  => $request->input('limit', 15),
            'sort'   => new SortDto(
                $request->input('sort_by', 'id'),
                $request->input('order_by', 'asc')
            ),
        ]);
    }
}
