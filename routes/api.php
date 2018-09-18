<?php

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('jwt.auth')->get('/me', function (Request $request) {
    return auth()->user();
});

Route::post('login', 'API\AuthController@login');
Route::post('logout', 'API\AuthController@logout');
Route::post('password', 'API\AuthController@cambiarContrasenia');
Route::post('auth/roles', 'API\AuthController@guardarRoles');
Route::get('auth/{usuarioid}/sistemas', 'API\AuthController@sistemas');
Route::get('auth/{usuarioid}/{sistemaid}/modulos', 'API\AuthController@modulos');
Route::get('auth/{usuarioid}/roles', 'API\AuthController@roles');
Route::get('auth/{rolid}/opciones', 'API\AuthController@opciones');

Route::apiResources([
    'usuarios' => 'API\UsuarioController',
    'roles' => 'API\RolController',
    'opciones' => 'API\OpcionController'
]);
