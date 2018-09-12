<?php

use Illuminate\Database\Seeder;
use App\Autorizacion;

class AutorizacionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('autorizaciones')->delete();
        $json = File::get('database/data-sample/autorizaciones.json');
        $data = json_decode($json);
        foreach ($data as $autorizacion) {
            Autorizacion::create(array(
                'id' => $autorizacion->id,
                'rol_id' => $autorizacion->rol_id,
                'sistema_id' => $autorizacion->sistema_id,
                'modulo_id' => $autorizacion->modulo_id,
                'opcion_id' => $autorizacion->opcion_id,
                'estado' => $autorizacion->estado,
                'creado_por' => $autorizacion->creado_por,
                'actualizado_por' => $autorizacion->actualizado_por
            ));
        }
    }
}
