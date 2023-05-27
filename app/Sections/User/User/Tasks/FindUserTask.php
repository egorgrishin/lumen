<?php

namespace Sections\User\User\Tasks;

use Core\Parents\BaseTask;
use Sections\User\User\Dto\FindUserDto;
use Sections\User\User\Models\User;

class FindUserTask extends BaseTask
{
    /**
     * Возвращает пользователя по ID
     */
    public function run(FindUserDto $dto): ?User
    {
        /** @var User|null */
        return User::query()
            ->select($dto->fields)
            ->find($dto->id);
    }
}
