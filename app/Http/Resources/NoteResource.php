<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function isCategory(){
        if($this->category_id != null){
            return $this->category->hash;
        }
        return "";
    }

    public function toArray($request)
    {
        return [
            'id' => $this->hash,
            'title' => $this->title,
            'description' => $this->description,
            'category_id' => $this->isCategory(),
            'created_date' => $this->created_at->format('d-m-y'),
            'created_time' => $this->created_at->format('h:i A'),
        ];
    }
}
