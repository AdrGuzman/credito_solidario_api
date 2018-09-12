<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sistema extends Model
{
    protected $table = 'sistemas';
    protected $fillable = [
        'nombre',
        'ruta',
        'estado',
        'creado_por',
        'actualizado_por'
    ];

    public function modulos() {
        return $this->hasMany('App\Modulo');
    }

    public function autorizaciones() {
        return $this->hasMany('App\Autorizacion');
    }
}
