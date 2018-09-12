<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SistemasResource extends JsonResource
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
            'ruta' => $this->ruta,
            'estado' => $this->estado,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por
        ];
    }
}
