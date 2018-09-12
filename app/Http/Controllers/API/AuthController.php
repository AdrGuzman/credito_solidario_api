<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Rol;
use Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use DB;
use App\Http\Resources\UsuariosResource;

class AuthController extends Controller
{
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'usuario' => 'required|string',
            'contrasenia' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //$credenciales = $request->only('usuario', 'contrasenia');
        
        try {
            if (!$token = auth()->attempt(array(
                    'usuario' => $request->usuario,
                    'password' => $request->contrasenia))) {
                return response()->json(['error' => 'Credenciales invalidas'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        $usuario_actual = $request->usuario;
        /*$usuario = DB::table('usuarios')->where('usuario', '=', $usuario_actual)->value('id');
        $roles = DB::table('usuarios_roles')
            ->join('roles', 'usuarios_roles.rol_id', '=', 'roles.id')
            ->select('roles.nombre')
            ->where('usuarios_roles.usuario_id', '=', $usuario)
            ->get();*/

        return response()->json([
            'token_acceso' => $token,
            'tipo_token' => 'bearer',
            'usuario_actual' => $usuario_actual,
            //'roles' => $roles,
            'expira_en' => auth()->factory()->getTTL() * 60
        ], 200);
    }

    function cambiarContrasenia(Request $request) {
        DB::table('usuarios')
            ->where('id', $request->usuarioid)
            ->update(['contrasenia' => bcrypt($request->contrasenia)]);

        return response()->json(['mensaje' => 'Contraseña cambiada'], 200);
    }

    function logout(Request $request) {
        auth()->logout(true);
        return response()->json(['success' => 'Cierre de sessión exitoso'], 200);
    }

    function sistemas(Request $request) {
        $sistemas = DB::table('autorizaciones')
            ->join('sistemas', 'autorizaciones.sistema_id', '=', 'sistemas.id')
            ->join('usuarios_roles', 'usuarios_roles.rol_id', '=', 'autorizaciones.rol_id')
            ->select('autorizaciones.sistema_id', 'sistemas.nombre')
            ->where([
                ['autorizaciones.estado', '=', 1],
                ['usuarios_roles.usuario_id', '=', $request->usuarioid]
            ])
            ->distinct()
            ->get();

        return response()->json($sistemas, 200);
    }

    function roles(Request $request) {
        $roles = DB::table('usuarios_roles')
            ->join('roles', 'usuarios_roles.rol_id', '=', 'roles.id')
            ->select('roles.id', 'roles.nombre')
            ->where('usuarios_roles.usuario_id', '=', $request->usuarioid)
            ->get();

        return response()->json($roles, 200);
    }

    function opciones(Request $request) {
        $opciones = DB::table('roles_opciones')
            ->select('opcion_id')
            ->where('roles_opciones.rol_id', '=', $request->rolid)
            ->get();

        return $opciones;
    }
}
