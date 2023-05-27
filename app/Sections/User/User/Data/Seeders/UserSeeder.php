<?php

namespace Sections\User\User\Data\Seeders;

use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function __construct(
        private readonly Generator $generator = new Generator()
    ) {}

    public function run(): void
    {
        $users = [];

        for ($i = 1; $i <= 100; $i++) {
            $users[] = $this->getFakeUserData();
            if ($i % 100 == 0) {
                DB::table('users')->insert($users);
                $users = [];
            }
        }

        if (count($users) > 0) {
            DB::table('users')->insert($users);
        }
    }

    private function getFakeUserData(): array
    {
        return [
            'name'              => $this->generator->name(),
            'email'             => $this->generator->unique()->email,
            'email_verified_at' => Date::now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role_id'           => rand(0, 100) == 0 ? 1 : 2,
        ];
    }
}
