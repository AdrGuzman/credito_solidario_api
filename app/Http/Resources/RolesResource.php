<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RolesResource extends JsonResource
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
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'fecha_expiracion' => $this->fecha_expiracion,
            'estado' => $this->estado,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
