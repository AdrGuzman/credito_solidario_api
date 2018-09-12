<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sistema;
use App\Http\Resources\SistemasResource;

class SistemaController extends Controller
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
        $sistemaLista = Sistema::all();
        return $sistemaLista;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $crearSistema = Sistema::create([
            'nombre' => $request->nombre,
            'ruta' => $request->ruta,
            'estado' => $request->estado,
            'creado_por' => $request->creado_por,
            'actualizado_por' => $request->actualizado_por
        ]);

        return new SistemasResource($crearSistema);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sistema $sistema) {
        return new SistemasResource($sistema);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sistema $sistema) {
        $sistema->update($request->only('nombre', 'ruta', 'estado', 'actualizado_por'));

        return new SistemasResource($sistema);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}
