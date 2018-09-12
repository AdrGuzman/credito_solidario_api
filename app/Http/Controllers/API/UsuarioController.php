<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validator;
use App\Http\Resources\UsuariosResource;

class UsuarioController extends Controller
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
        $usuariosLista = User::all();
        return $usuariosLista;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $crearUsuario = User::create([
            'usuario' => $request->usuario,
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'fecha_ingreso' => $request->fecha_ingreso,
            'estado' => $request->estado,
            'contrasenia' => bcrypt($request->contrasenia)
        ]);

        return new UsuariosResource($crearUsuario);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $usuario)
    {
        return new UsuariosResource($usuario);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $usuario)
    {
        /*$validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'correo' => 'required',
            'fecha_ingreso' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }*/

        $usuario->update($request->only('nombre', 'correo', 'fecha_ingreso'));

        return new UsuariosResource($usuario);
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
