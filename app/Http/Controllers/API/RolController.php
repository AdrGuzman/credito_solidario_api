<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rol;
use Validator;
use App\Http\Resources\RolesResource;

class RolController extends Controller
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
        $rolesLista = Rol::all();
        return $rolesLista;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $crearRol = Rol::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fecha_expiracion' => $request->fecha_expiracion,
            'estado' => $request->estado
        ]);

        return new RolesResource($crearRol);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Rol $rol)
    {
        return new RolesResource($rol);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rol $rol)
    {
        $rol->update($request->only('nombre', 'descripcion', 'fecha_expiracion', 'estado'));

        return new RolesResource($rol);
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
