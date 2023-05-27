<?php

namespace Core\Classes\Illuminate\Dto;

use Core\Parents\BaseDto;

readonly class SortDto extends BaseDto
{
    public function __construct(
        public string $sort_by,
        public string $order_by
    ) {}
}
