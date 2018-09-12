<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';
    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_expiracion',
        'estado'
    ];

    public function usuarios() {
        return $this->belongsToMany('App\User');
    }

    public function autorizaciones() {
        return $this->hasMany('App\Autorizacion');
    }

    /*public function opciones() {
        return $this->belongsToMany('App\Opcion', 'roles_opciones', 'rol_id', 'opcion_id')
            ->withPivot('creado_por', 'actualizado_por')
            ->withTimestamps();
    }*/
}
