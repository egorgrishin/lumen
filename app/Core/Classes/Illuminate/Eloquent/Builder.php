<?php

namespace Core\Classes\Illuminate\Eloquent;

use Core\Classes\Illuminate\Dto\SortDto;
use Core\Parents\BaseModel;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

/**
 * @method BaseModel|Collection|null find($id, $columns = ['*'])
 * @method Collection get($columns = ['*'])
 */
class Builder extends EloquentBuilder
{
    public function setSort(SortDto $dto): self
    {
        return $this->orderBy($dto->sort_by, $dto->order_by);
    }
}
