<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Opcion;
use Validator;
use App\Http\Resources\OpcionesResource;

class OpcionController extends Controller
{
    public function __construct() {
        //$this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $opcionesLista = Opcion::all();
        return $opcionesLista;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $crearOpcion = Opcion::create([
            'sistema_id' => $request->sistema_id,
            'modulo_id' => $request->modulo_id,
            'nombre' => $request->nombre,
            'estado' => $request->estado,
            'creado_por' => $request->creado_por,
            'actualizado_por' => $request->actualizado_por
        ]);

        return new OpcionesResource($crearOpcion);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Opcion $opcione)
    {
        return new OpcionesResource($opcion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Opcion $opcione)
    {
        $opcion->update($request->only('sistema_id', 'modulo_id', 'nombre', 'estado', 'creado_por', 'actualizado_por'));

        return new OpcionesResource($opcion);
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
