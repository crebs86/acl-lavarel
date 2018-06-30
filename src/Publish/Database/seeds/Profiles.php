<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class Profiles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->insert([
            'user_id'=>1,
            'branch_line'=>'0000',
            'address'=>'Administration Sector',
            'sector'=>'TI',
            'full_name'=>'System Super Administrator'
        ]);
    }
}
