<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Permissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = array(

            /*
             * --------------------------------------------------------- *
             * --------------------------------------------------------- *
             *
             * Start general use
             *
             * --------------------------------------------------------- *
             * --------------------------------------------------------- *
             */
            ['name' => 'acl_manager', 'label' => 'Manager roles and permissions', 'created_at'=> now(), 'updated_at'=>now()],//1
            ['name' => 'acl_view', 'label' => 'View roles and permissions', 'created_at'=> now(), 'updated_at'=>now()],//2

            ['name' => 'user_view', 'label' => 'View users info', 'created_at'=> now(), 'updated_at'=>now()],//3
            ['name' => 'user_view_self', 'label' => 'View own info', 'created_at'=> now(), 'updated_at'=>now()],//4

            ['name' => 'user_create', 'label' => 'Create users', 'created_at'=> now(), 'updated_at'=>now()],//5

            ['name' => 'user_edit', 'label' => 'Edit users data', 'created_at'=> now(), 'updated_at'=>now()],//6
            ['name' => 'user_edit_self', 'label' => 'Edit own data', 'created_at'=> now(), 'updated_at'=>now()],//7

            ['name' => 'user_delete', 'label' => 'Delete a user', 'created_at'=> now(), 'updated_at'=>now()],//8
            ['name' => 'user_delete_self', 'label' => 'Delete your self account', 'created_at'=> now(), 'updated_at'=>now()],//9

            ['name' => 'system_manager', 'label' => 'System Manager', 'created_at'=> now(), 'updated_at'=>now()],//10
            ['name' => 'user_manager', 'label' => 'User Manager', 'created_at'=> now(), 'updated_at'=>now()],//11
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

            ['name' => 'post_manager', 'label' => 'Manager the posts', 'created_at'=> now(), 'updated_at'=>now()],//12
            ['name' => 'post_view', 'label' => 'View the posts', 'created_at'=> now(), 'updated_at'=>now()],//13
            ['name' => 'post_edit', 'label' => 'Edit a post', 'created_at'=> now(), 'updated_at'=>now()],//14
            ['name' => 'post_create', 'label' => 'Create a post', 'created_at'=> now(), 'updated_at'=>now()],//15
            ['name' => 'post_delete', 'label' => 'Delete a post', 'created_at'=> now(), 'updated_at'=>now()],//16

            ['name' => 'post_view_self', 'label' => 'View own posts', 'created_at'=> now(), 'updated_at'=>now()],//17
            ['name' => 'post_edit_self', 'label' => 'Edit own posts', 'created_at'=> now(), 'updated_at'=>now()],//18
            ['name' => 'post_create_self', 'label' => 'Create a post', 'created_at'=> now(), 'updated_at'=>now()],//19
            ['name' => 'post_delete_self', 'label' => 'Delete own posts', 'created_at'=> now(), 'updated_at'=>now()],//20

            /*
             * --------------------------------------------------------- *
             * --------------------------------------------------------- *
             *
             * End posts based use
             *
             * --------------------------------------------------------- *
             * --------------------------------------------------------- *
             */

        );

        DB::table('permissions')->insert($permissions);
    }
}
