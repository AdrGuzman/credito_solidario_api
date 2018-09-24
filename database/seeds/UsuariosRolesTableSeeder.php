<?php

use Illuminate\Database\Seeder;

class UsuariosRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios_roles')->delete();
        DB::table('usuarios_roles')->insert([
            'usuario_id' => 1,
            'rol_id' => 1,
            'creado_por' => 1,
            'actualizado_por' => 1,
            'fecha_expiracion' => '2018-09-25 11:06:20'
        ]);
        DB::table('usuarios_roles')->insert([
            'usuario_id' => 2,
            'rol_id' => 2,
            'creado_por' => 1,
            'actualizado_por' => 1,
            'fecha_expiracion' => '2018-09-25 11:06:20'
        ]);
    }
}
