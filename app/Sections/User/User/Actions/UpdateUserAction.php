<?php

namespace Sections\User\User\Actions;

use Core\Parents\BaseAction;
use Sections\User\User\Dto\UpdateUserDto;
use Sections\User\User\Tasks\UpdateUserTask;
use Sections\User\User\Tasks\UserIsExistsTask;

class UpdateUserAction extends BaseAction
{
    /**
     * Обвновляет пользователя
     */
    public function run(UpdateUserDto $dto): ?array
    {
        if (!$this->task(UserIsExistsTask::class)->run($dto->id)) {
            return null;
        }

        return $this->task(UpdateUserTask::class)
            ->run($dto)
            ?->toArray();
    }
}
