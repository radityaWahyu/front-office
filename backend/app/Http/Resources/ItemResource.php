<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'type' => $this->type,
            'departement_id' => $this->departement_id,
            'departement_name' => $this->departement_id != null ? $this->departements->name : null,
            'unit_id' => $this->unit_id,
            'unit_name' => $this->unit_id != null ? $this->units->name : null,
            'created' => $this->created_at->format('d-m-Y'),
            'updated' => $this->updated_at->format('d-m-Y')
        ];
    }
}
