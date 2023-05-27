<?php

namespace Core\Data\Seeders;

use Illuminate\Database\Seeder;
use Sections\User\Role\Data\Seeders\RoleSeeder;
use Sections\User\User\Data\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
        ]);
    }
}
