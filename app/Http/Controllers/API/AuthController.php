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
            ->select('autorizaciones.sistema_id as id', 'sistemas.nombre', 'sistemas.ruta')
            ->where([
                ['autorizaciones.estado', '=', 1],
                ['usuarios_roles.usuario_id', '=', $request->usuarioid],
                ['usuarios_roles.estado', '=', 1]
            ])
            ->distinct()
            ->get();

        return response()->json($sistemas, 200);
    }

    function modulos(Request $request) {
        $roles = DB::table('autorizaciones')
            ->join('sistemas', 'autorizaciones.sistema_id', '=', 'sistemas.id')
            ->join('usuarios_roles', 'usuarios_roles.rol_id', 'autorizaciones.rol_id')
            ->join('modulos', 'autorizaciones.modulo_id', '=', 'modulos.id')
            ->select('modulos.id as id', 'modulos.nombre', 'modulos.ruta')
            ->where([
                ['autorizaciones.estado', '=', 1],
                ['usuarios_roles.usuario_id', '=', $request->usuarioid],
                ['autorizaciones.sistema_id', '=', $request->sistemaid]
            ])
            ->distinct()
            ->get();

        return response()->json($roles, 200);
    }

    function roles(Request $request) {
        $roles = DB::table('usuarios_roles')
            ->join('roles', 'usuarios_roles.rol_id', '=', 'roles.id')
            ->select('roles.id as id', 'roles.nombre as nombre', 'usuarios_roles.fecha_expiracion as fechaExpiracion')
            ->where([
                ['usuarios_roles.usuario_id', '=', $request->usuarioid],
                ['usuarios_roles.estado', '=', 1]
                ])
            ->get();

        return response()->json($roles, 200);
    }

    public function rol(Request $request) {
        $rol = DB::table('usuarios_roles')
            ->select('usuarios_roles.rol_id as rolId', 'usuarios_roles.fecha_expiracion as fechaExpiracion', 'usuarios_roles.estado')
            ->where([
                ['usuarios_roles.rol_id', '=', $request->rolid],
                ['usuarios_roles.usuario_id', '=', $request->usuarioid]
            ])
            ->first();

        $rol->fechaExpiracion = \Carbon\Carbon::parse($rol->fechaExpiracion)->format('c');
        //echo $algo;
        //die();

        //->select('usuarios_roles.rol_id as rolId', DB::raw('DATE_FORMAT(usuarios_roles.fecha_expiracion, "%Y/%m/%d %H:%i:%s") as fechaExpiracion'), 'usuarios_roles.estado')

        return response()->json($rol, 200);
    }

    public function guardarRoles(Request $request) {
        $data = json_decode($request->getContent(), true);
        
        foreach ($data as $rol) {
            DB::table('usuarios_roles')->insert(
                ['usuario_id' => $rol['usuarioId'],
                'rol_id' => $rol['rolId'],
                'estado' => $rol['estado'],
                'creado_por' => 'USR',
                'actualizado_por' => 'USR',
                'fecha_expiracion' => date('Y-m-d h:i:s', strtotime($rol['fechaExpiracion']))
                ]
            );
        }

        $response = array(
            'mensaje' => 'Roles registrados'
        );

        return response()->json($response, 200);
    }

    public function actualizarRol(Request $request) {
        $updateDetails = array(
            'fecha_expiracion' => $request->fechaExpiracion,
            'estado' => $request->estado,
            'actualizado_por' => $request->actualizadoPor
        );

        DB::table('usuarios_roles')
            ->where([
                ['usuario_id', '=', $request->usuarioId],
                ['rol_id', '=', $request->rolId]
            ])
            ->update($updateDetails);
        
        $response = array(
            'mensaje' => 'Rol actualizado'
        );

        return response()->json($response, 200);
    }

    public function opciones(Request $request) {
        $opciones = DB::table('roles_opciones')
            ->select('opcion_id')
            ->where('roles_opciones.rol_id', '=', $request->rolid)
            ->get();

        return $opciones;
    }

    public function obtenerAutorizaciones(Request $request) {
        $autorizaciones = DB::table('autorizaciones')
            ->join('opciones', 'autorizaciones.opcion_id', '=', 'opciones.id')
            ->join('usuarios_roles', 'autorizaciones.rol_id', '=', 'usuarios_roles.rol_id')
            ->join('modulos', 'autorizaciones.modulo_id', '=', 'modulos.id')
            ->select('opciones.nombre')
            ->where([
                ['usuarios_roles.rol_id', '=', $request->usuario],
                ['modulos.nombre', '=', $request->modulo],
                ['usuarios_roles.estado', '=', 1],
                ['autorizaciones.estado', '=', 1]
            ])
            ->distinct()
            ->get();

        return response()->json($autorizaciones, 200);
    }
}
