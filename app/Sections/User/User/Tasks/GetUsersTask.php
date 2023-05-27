<?php

namespace Sections\User\User\Tasks;

use Core\Classes\Illuminate\Eloquent\Collection;
use Core\Parents\BaseTask;
use Sections\User\User\Dto\GetUsersDto;
use Sections\User\User\Models\User;

class GetUsersTask extends BaseTask
{
    /**
     * Возвращает коллекцию пользователей
     */
    public function run(GetUsersDto $dto): Collection
    {
        return User::query()
            ->select($dto->fields)
            ->limit($dto->limit)
            ->offset($dto->offset)
            ->setSort($dto->sort)
            ->get();
    }
}
