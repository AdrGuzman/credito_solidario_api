<?php

use Illuminate\Database\Seeder;
use App\User;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->delete();
        $json = File::get('database/data-sample/usuarios.json');
        $data = json_decode($json);
        foreach ($data as $usuario) {
            User::create(array(
                'id' => $usuario->id,
                'usuario' => $usuario->usuario,
                'nombre' => $usuario->nombre,
                'correo' => $usuario->correo,
                'contrasenia' => bcrypt($usuario->contrasenia),
                'fecha_ingreso' => $usuario->fecha_ingreso,
                'estado' => $usuario->estado
            ));
        }
    }
}
