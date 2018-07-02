<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class Roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array(

            /*
             * --------------------------------------------------------- *
             * --------------------------------------------------------- *
             *
             * Start general use
             *
             * --------------------------------------------------------- *
             * --------------------------------------------------------- *
             */
            ['name'=>'super-admin', 'label'=>'Adiministradot total do sistema', 'created_at'=> now(), 'updated_at'=>now()],//1
            ['name'=>'admin', 'label'=>'Administrador limitado do sistema', 'created_at'=> now(), 'updated_at'=>now()],//2


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

            ['name'=>'reviewer', 'label'=>'Edita, publica e libera publicações no sistema', 'created_at'=> now(), 'updated_at'=>now()],//3
            ['name'=>'publisher', 'label'=>'Realiza suas próprias publicações', 'created_at'=> now(), 'updated_at'=>now()],//4
            ['name'=>'user', 'label'=>'Usuário registrado, sem mais privilégios', 'created_at'=> now(), 'updated_at'=>now()],//5
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
        DB::table('roles')->insert($roles);
    }
}
