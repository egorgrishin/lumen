<?php

namespace Core\Parents;

use Core\Classes\Illuminate\Eloquent\Builder;
use Core\Classes\Illuminate\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */
abstract class BaseModel extends Model
{
    public static array $fields = [];

    public static int $max_limit = 20;

    public function newCollection(array $models = []): Collection
    {
        return new Collection($models);
    }

    public static function query(): Builder
    {
        /** @var Builder */
        return (new static)->newQuery();
    }

    public function newEloquentBuilder($query): Builder
    {
        return new Builder($query);
    }
}
