<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Veelasky\LaravelHashId\Eloquent\HashableId;
use Laravel\Scout\Searchable;
use Laravel\Scout\Builder;

class Survey extends Model
{
    use HasFactory, HashableId, Searchable;

    protected $fillable = [
        'business_name',
        'business_type',
        'owner_name',
        'staff_id',
        'phone_no',
        'address',
        'latitude_logitude',
        'photo',
        'staff_remark',
        'manager_remark',
        'status',
    ];

    protected $attributes = [
        'status' => 'pending',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function dashboards(){
        return $this->morphMany(Dashboard::class, 'countable');
    }

    public function toSearchableArray()
    {
        return [
            'business_name' => $this->business_name,
            'business_type' => $this->business_type,
            'owner_name' => $this->owner_name,
            'phone_no' => $this->phone_no,
            'address' => $this->address,
        ];
    }
}
