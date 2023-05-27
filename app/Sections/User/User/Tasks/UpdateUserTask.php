<?php

namespace Sections\User\User\Tasks;

use Core\Parents\BaseTask;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Sections\User\User\Dto\UpdateUserDto;
use Sections\User\User\Models\User;

class UpdateUserTask extends BaseTask
{
    /**
     * Обновляет пользователя
     */
    public function run(UpdateUserDto $dto): ?User
    {
        return DB::transaction(function () use ($dto) {
            $user = $this->findUser($dto->id);

            $user->name = $dto->name;
            $user->email = $dto->email;
            $user->password = Hash::make($dto->password);

            $user->save();
            return $user;
        });
    }

    /**
     * Возвращает модель пользователя для обновления
     */
    private function findUser(int $user_id): User
    {
        /** @var User */
        return User::query()->find($user_id);
    }
}
