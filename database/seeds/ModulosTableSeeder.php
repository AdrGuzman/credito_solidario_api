<?php

use Illuminate\Database\Seeder;
use App\Modulo;

class ModulosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modulos')->delete();
        $json = File::get('database/data-sample/modulos.json');
        $data = json_decode($json);
        foreach ($data as $modulo) {
            Modulo::create(array(
                'id' => $modulo->id,
                'sistema_id' => $modulo->sistema_id,
                'nombre' => $modulo->nombre,
                'ruta' => $modulo->ruta,
                'estado' => $modulo->estado,
                'creado_por' => $modulo->creado_por,
                'actualizado_por' => $modulo->actualizado_por
            ));
        }
    }
}
