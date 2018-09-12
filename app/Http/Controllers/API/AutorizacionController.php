<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Autorizacion;
use App\Http\Resources\AutorizacionesResource;

class AutorizacionController extends Controller
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
        $autorizacionesLista = Autorizacion::all();
        return $autorizacionesLista;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $crearAutorizacion = Autorizacion::create([
            'rol_id' => $request->rol_id,
            'sistema_id' => $request->sistema_id,
            'modulo_id' => $request->modulo_id,
            'opcion_id' => $request->opcion_id,
            'estado' => $request->estado,
            'creado_por' => $request->creado_por,
            'actualizado_por' => $request->actualizado_por
        ]);

        return new AutorizacionesResource($crearAutorizacion);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Autorizacion $autorizacion) {
        return new AutorizacionesResource($autorizacion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Autorizacion $autorizacion) {
        $autorizacion->update(
            'rol_id',
            'sistema_id',
            'modulo_id',
            'opcion_id',
            'estado',
            'creado_por',
            'actualizado_por');

        return new AutorizacionesResource($autorizacion);
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
