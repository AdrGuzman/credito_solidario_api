<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opcion extends Model
{
    protected $table = 'opciones';
    protected $fillable = [
        'sistema_id',
        'modulo_id',
        'nombre',
        'estado',
        'creado_por',
        'actualizado_por'
    ];

    public function autorizaciones() {
        return $this->hasMany('App\Autorizacion');
    }

    /*public function roles() {
        return $this->belongsToMany('App\Rol');
    }*/
}
