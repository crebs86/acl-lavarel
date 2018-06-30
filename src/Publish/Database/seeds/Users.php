<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(array(
            [
                //user ID 1
                'name'=>'Super Admiministrator',
                'email'=>'super-admin@your.app',
                'password'=>bcrypt('crebsacl'),
                'verified'=>true,
                'active'=>true,
                'created_at'=>now(),
                'updated_at'=>now(),
            ]));
    }
}
