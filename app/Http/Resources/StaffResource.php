<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StaffResource extends JsonResource
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
            'id' => $this->hash,
            'name' => $this->name,
            'gender' => $this->gender,
            'position' => $this->position,
            'phone_no' => $this->phone_no,
            'email' => $this->email,
            'color_name' => $this->color_name,
            'profile_name' => $this->profile_name,
        ];
    }
}
