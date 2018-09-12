<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsuariosResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'usuario' => $this->usuario,
            'nombre' => $this->nombre,
            'fecha_ingreso' => $this->fecha_ingreso,
            'correo' => $this->correo,
            'estado' => $this->estado,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
