<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AutorizacionesResource extends JsonResource
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
            'opcion_id' => $this->opcion_id,
            'estado' => $this->estado,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por
        ];
    }
}
