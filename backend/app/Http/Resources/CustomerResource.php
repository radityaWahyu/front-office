<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'gender' => $this->gender,
            'address' => $this->address,
            'telephone' => $this->telp,
            'created' => $this->created_at->format('d-m-Y'),
            'updated' => $this->updated_at->format('d-m-Y')
        ];
    }
}
