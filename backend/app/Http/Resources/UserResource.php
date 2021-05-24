<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'username' => $this->username,
            'email' => $this->email,
            'role' => $this->role,
            'departement_id' => $this->departement_id,
            'departement_name' => $this->departement_id != null ? $this->departements->name : null,
            'created' => $this->created_at->format('d-m-Y'),
            'updated' => $this->updated_at->format('d-m-Y')
        ];
    }
}
