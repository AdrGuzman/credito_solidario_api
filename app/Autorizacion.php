<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autorizacion extends Model
{
    protected $table = 'autorizaciones';
    protected $fillable = [
        'rol_id',
        'sistema_id',
        'modulo_id',
        'opcion_id',
        'estado',
        'creado_por',
        'actualizado_por'
    ];
}
