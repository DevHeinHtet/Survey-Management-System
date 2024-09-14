<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Veelasky\LaravelHashId\Eloquent\HashableId;

class Category extends Model
{
    use HasFactory, HashableId;

    protected $fillable = [
        'name',
        'staff_id',
    ];
    
}
