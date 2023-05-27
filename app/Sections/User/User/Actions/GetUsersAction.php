<?php

namespace Sections\User\User\Actions;

use Core\Parents\BaseAction;
use Sections\User\User\Dto\GetUsersDto;
use Sections\User\User\Tasks\GetUsersTask;

class GetUsersAction extends BaseAction
{
    /**
     * Возвращает список пользователей
     */
    public function run(GetUsersDto $dto): array
    {
        return $this->task(GetUsersTask::class)->run($dto);
    }
}
