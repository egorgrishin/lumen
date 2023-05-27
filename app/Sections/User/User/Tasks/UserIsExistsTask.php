<?php

namespace Sections\User\User\Tasks;

use Core\Parents\BaseTask;
use Sections\User\User\Models\User;

class UserIsExistsTask extends BaseTask
{
    /**
     * Проверяет существование пользователя с указанным ID
     */
    public function run(int $user_id): bool
    {
        return User::query()
            ->where('id', $user_id)
            ->exists();
    }
}
