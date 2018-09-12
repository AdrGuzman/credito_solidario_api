<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    protected $table = 'modulos';
    protected $fillable = [
        'sistema_id',
        'nombre',
        'ruta',
        'estado',
        'creado_por',
        'actualizado_por'
    ];

    public function opciones() {
        return $this->hasMany('App/Opcion');
    }

    public function autorizaciones() {
        return $this->hasMany('App\Autorizacion');
    }
}
