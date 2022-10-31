<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class NotebookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'companyName' => $this->companyName,
            'phoneNumber' => $this->phoneNumber,
            'email' => $this->email,
            'birthDate' => $this->birthDate,
            'image' => isset($this->imagePath) ? asset('storage/' . $this->imagePath) : null,
        ];
    }
}
