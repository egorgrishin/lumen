<?php

namespace Sections\User\User\Actions;

use Core\Parents\BaseAction;
use Sections\User\User\Dto\FindUserDto;
use Sections\User\User\Tasks\FindUserTask;

class FindUserAction extends BaseAction
{
    /**
     * Возвращает пользователя по ID
     */
    public function run(FindUserDto $dto): ?array
    {
        return $this->task(FindUserTask::class)
            ->run($dto)
            ?->toArray();
    }
}
