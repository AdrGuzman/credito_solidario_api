<?php

use Illuminate\Database\Seeder;

class RolesOpcionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles_opciones')->delete();
        DB::table('roles_opciones')->insert([
            'rol_id' => 1,
            'opcion_id' => 1,
            'creado_por' => 1,
            'actualizado_por' => 1
        ]);
        DB::table('roles_opciones')->insert([
            'rol_id' => 1,
            'opcion_id' => 2,
            'creado_por' => 1,
            'actualizado_por' => 1
        ]);
        DB::table('roles_opciones')->insert([
            'rol_id' => 1,
            'opcion_id' => 3,
            'creado_por' => 1,
            'actualizado_por' => 1
        ]);
    }
}
