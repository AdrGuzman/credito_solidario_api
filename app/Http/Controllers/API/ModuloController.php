<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modulo;
use App\Http\Resources\ModulosResource;

class ModuloController extends Controller
{
    public function __construct() {
        //$this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $modulosLista = Modulo::all();
        return $modulosLista;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $crearModulo = Module::create([
            'sistema_id' => $request->sistema_id,
            'nombre' => $request->nombre,
            'ruta' => $request->ruta,
            'estado' => $request->estado,
            'creado_por' => $request->creado_por,
            'actualizado_por' => $request->actualizado_por
        ]);

        return new ModulosResurce($crearModulo);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Modulo $modulo) {
        return new ModulosResource($modulo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modulo $modulo) {
        $modulo->update('sistema_id', 'nombre', 'ruta', 'estado', 'actualizado_por');

        return new ModulosResource($modulo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
