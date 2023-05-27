<?php

namespace Sections\User\User\Tasks;

use Core\Parents\BaseTask;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Sections\User\User\Dto\CreateUserDto;
use Sections\User\User\Models\User;

class CreateUserTask extends BaseTask
{
    /**
     * Создает нового пользователя
     */
    public function run(CreateUserDto $dto): User
    {
        return DB::transaction(function () use ($dto) {
            $user = new User();

            $user->name = $dto->name;
            $user->email = $dto->email;
            $user->password = Hash::make($dto->password);

            $user->save();
            return $user;
        });
    }
}
