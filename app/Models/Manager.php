<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Veelasky\LaravelHashId\Eloquent\HashableId;
use Laravel\Sanctum\HasApiTokens;

class Manager extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HashableId;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'file',
    ];

    protected $attributes = [
        'position' => 'director',
        'file' => 'default_profile.png'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function detail(){
        return $this->morphOne(Detail::class, 'detailable');
    }

    public function getProfile(){
        if($this->file){
            return asset('/storage/images/manager/'.$this->file);
        }else{
            return asset('/storage/images/manager/default_profile.png');
        }
    }
}
