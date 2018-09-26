<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OpcionesResource extends JsonResource
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
            'sistema_id' => $this->sistema_id,
            'modulo_id' => $this->modulo_id,
            'nombre' => $this->nombre,
            'estado' => $this->estado,
            'creado_por' => (string) $this->creado_por,
            'actualizado_por' => (string) $this->actualizado_por
        ];
    }
}
