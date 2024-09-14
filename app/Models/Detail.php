<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone_no',
        'address',
        'url',
        'city',
        'country',
    ];

    public function detailable(){
        return $this->morphTo(__FUNCTION__, 'detailable_type', 'detailable_id');
    }

    public function getCountry(){
        if($this->country == 'my'){
            return  'Myanmar';
        }
        return '';
    }
}
