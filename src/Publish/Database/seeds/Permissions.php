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
            ['name' => 'acl_manager', 'label' => 'Gerencias papéis e permissões do sistema', 'created_at'=> now(), 'updated_at'=>now()],//1
            ['name' => 'acl_view', 'label' => 'Permite Visualizar Papéis e Permissões', 'created_at'=> now(), 'updated_at'=>now()],//2

            ['name' => 'user_view', 'label' => 'Visualiza informações de usuários', 'created_at'=> now(), 'updated_at'=>now()],//3
            ['name' => 'user_view_self', 'label' => 'Visualiza informações do próprio usuário', 'created_at'=> now(), 'updated_at'=>now()],//4

            ['name' => 'user_create', 'label' => 'Cria usuários no sistema', 'created_at'=> now(), 'updated_at'=>now()],//5

            ['name' => 'user_edit', 'label' => 'Edita informações de usuários', 'created_at'=> now(), 'updated_at'=>now()],//6
            ['name' => 'user_edit_self', 'label' => 'Edita informações do próprio usuário', 'created_at'=> now(), 'updated_at'=>now()],//7

            ['name' => 'user_delete', 'label' => 'Apaga um usuário no sistema', 'created_at'=> now(), 'updated_at'=>now()],//8
            ['name' => 'user_delete_self', 'label' => 'Apaga sua própria conta no sistema', 'created_at'=> now(), 'updated_at'=>now()],//9

            ['name' => 'user_user', 'label' => 'Capaz de visualizar e editar seu próprio perfil', 'created_at'=> now(), 'updated_at'=>now()],//10


            ['name' => 'system_manager', 'label' => 'System Manager', 'created_at'=> now(), 'updated_at'=>now()],//11
            ['name' => 'user_manager', 'label' => 'User Manager', 'created_at'=> now(), 'updated_at'=>now()],//12
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

            ['name' => 'post_manager', 'label' => 'Gerencia todas as publicações', 'created_at'=> now(), 'updated_at'=>now()],//13
            ['name' => 'post_view', 'label' => 'Visualiza próprias publicações', 'created_at'=> now(), 'updated_at'=>now()],//14
            ['name' => 'post_edit', 'label' => 'Edita próprias publicações', 'created_at'=> now(), 'updated_at'=>now()],//15
            ['name' => 'post_create', 'label' => 'Cria próprias publicações', 'created_at'=> now(), 'updated_at'=>now()],//16
            ['name' => 'post_delete', 'label' => 'Apaga próprias publicações', 'created_at'=> now(), 'updated_at'=>now()],//17

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
