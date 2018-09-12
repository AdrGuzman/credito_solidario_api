<?php

use Illuminate\Database\Seeder;
use App\Sistema;

class SistemasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sistemas')->delete();
        $json = File::get('database/data-sample/sistemas.json');
        $data = json_decode($json);
        foreach ($data as $sistema) {
            Sistema::create(array(
                'id' => $sistema->id,
                'nombre' => $sistema->nombre,
                'ruta' => $sistema->ruta,
                'estado' => $sistema->estado,
                "creado_por" => $sistema->creado_por,
                "actualizado_por" => $sistema->actualizado_por
            ));
        }
    }
}
