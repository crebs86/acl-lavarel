<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            Users::class,
            Profiles::class,
            Permissions::class,
            Roles::class,
            PermissionsRole::class,
            RoleUser::class,
            Settings::class
        ]);
    }
}
