<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SurveyResource extends JsonResource
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
            'business_name' => $this->business_name,
            'business_type' => $this->business_type,
            'owner_name' => $this->owner_name,
            'phone_no' => $this->phone_no,
            'address' => $this->address,
            'photo' => $this->photo,
            'staff_remark' => $this->staff_remark,
            'status' => $this->status,
            'created_date' => $this->created_at->format('d-m-y'),
            'created_time' => $this->created_at->format('h:i A'),
        ];
    }
}
