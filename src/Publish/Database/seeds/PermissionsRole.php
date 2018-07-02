<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PermissionsRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * --------------------------------------------------------- *
         * --------------------------------------------------------- *
         *
         * Start general use
         *
         * --------------------------------------------------------- *
         * --------------------------------------------------------- *
         */

        $permissionsRole = array(
            /**
             * admin user
             */
            ['permission_id' => '1', 'role_id' => '2'],//'admin'=>'acl_manager'
            ['permission_id' => '2', 'role_id' => '2'],//'admin'=>'acl_view'
            ['permission_id' => '10', 'role_id' => '2'],//'admin'=>'system_manager'
            ['permission_id' => '11', 'role_id' => '2'],//'admin'=>'user_manager'

            ['permission_id' => '4', 'role_id' => '5'],//'user'=>'user_view_self'
            ['permission_id' => '7', 'role_id' => '5'],//'user'=>'user_edit_self'
            ['permission_id' => '9', 'role_id' => '5'],//'user'=>'user_delete_self'
            /**
             * general user
             */
            /*
             * --------------------------------------------------------- *
             * --------------------------------------------------------- *
             *
             * End general use
             *
             * --------------------------------------------------------- *
             * --------------------------------------------------------- *
             */

            /*
             * --------------------------------------------------------- *
             * --------------------------------------------------------- *
             *
             * Begin posts based use
             *
             * --------------------------------------------------------- *
             * --------------------------------------------------------- *
             */

            ['permission_id' => '12', 'role_id' => '3'],//'reviewer'=>'post_manager'

            ['permission_id' => '17', 'role_id' => '4'],//'publisher'=>'post_view_self'
            ['permission_id' => '18', 'role_id' => '4'],//'publisher'=>'post_edit_self'
            ['permission_id' => '19', 'role_id' => '4'],//'publisher'=>'post_create_self'
            ['permission_id' => '20', 'role_id' => '4'],//'publisher'=>'post_delete_self'

            /*
             * --------------------------------------------------------- *
             * --------------------------------------------------------- *
             *
             * Begin posts based use
             *
             * --------------------------------------------------------- *
             * --------------------------------------------------------- *
             */
        );

        DB::table('permission_role')->insert($permissionsRole);

    }
}
