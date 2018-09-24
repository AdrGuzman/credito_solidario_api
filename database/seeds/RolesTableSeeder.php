<?php

use Illuminate\Database\Seeder;
use App\Rol;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        $json = File::get('database/data-sample/roles.json');
        $data = json_decode($json);
        foreach ($data as $rol) {
            Rol::create(array(
                'id' => $rol->id,
                'nombre' => $rol->nombre,
                'descripcion' => $rol->descripcion,
                'estado' => $rol->estado
            ));
        }
    }
}
