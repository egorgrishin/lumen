<?php

namespace Sections\User\User\Actions;

use Core\Parents\BaseAction;
use Sections\User\User\Dto\CreateUserDto;
use Sections\User\User\Models\User;
use Sections\User\User\Tasks\CreateUserTask;

class CreateUserAction extends BaseAction
{
    /**
     * Создает нового пользователя
     */
    public function run(CreateUserDto $dto): User
    {
        return $this->task(CreateUserTask::class)->run($dto);
    }
}
