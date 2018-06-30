<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RoleUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role=array(
            ['user_id'=>'1', 'role_id'=>'1']
        );

        DB::table('role_user')->insert($role);
    }
}
