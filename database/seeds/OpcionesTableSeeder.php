<?php

use Illuminate\Database\Seeder;
use App\Opcion;

class OpcionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('opciones')->delete();
        $json = File::get('database/data-sample/opciones.json');
        $data = json_decode($json);
        foreach ($data as $opcion) {
            Opcion::create(array(
                'id' => $opcion->id,
                'sistema_id' => $opcion->sistema_id,
                'modulo_id' => $opcion->modulo_id,
                'nombre' => $opcion->nombre,
                'estado' => $opcion->estado,
                'creado_por' => $opcion->creado_por,
                'actualizado_por' => $opcion->actualizado_por
            ));
        }
    }
}
