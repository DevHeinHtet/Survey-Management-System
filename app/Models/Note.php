<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Veelasky\LaravelHashId\Eloquent\HashableId;

class Note extends Model
{
    use HasFactory, HashableId;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'staff_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
