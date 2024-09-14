<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'count',
        'type',
        'status',
        'date',
        'staff_id'
    ];
}
