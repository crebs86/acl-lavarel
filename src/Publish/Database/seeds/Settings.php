<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Settings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = array([
            'name' => 'default',
            'label' => 'Default Settings',
            'validate_mail' => true,
            'ac_account' => true,
            'protect_register_form' => true,
            'protect_register_form_admin' => true,
            'menu_show_users'=>false,
            'active' => true
        ]);
        DB::table('settings')->insert($setting);
    }
}
