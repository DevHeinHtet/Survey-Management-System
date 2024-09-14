<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Notifications\Notifiable;
use App\Http\Middleware\StaffMiddleware;
use Laravel\Sanctum\HasApiTokens;
use Veelasky\LaravelHashId\Eloquent\HashableId;

class Staff extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HashableId;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'gender',
        'position',
        'phone_no',
        'email',
        'password',
        'color_name',
        'profile_name',
        'is_active',
    ];

    protected $attributes = [
        'color_name' => 'theme-blue',
        'is_active' => true,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'is_active',
        'email_verified_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function surveys()
    {
        return $this->hasMany(Survey::class);
    }
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function category(){
        return $this->hasMany(Category::class);
    }

    public function dashboards(){
        return $this->morphMany(Dashboard::class, 'countable');
    }

    public function getProfileNameAttribute($value){
        if($value){
            return asset('/storage/images/'.$value);
        }else{
            return asset('/storage/images/default_profile.png');
        }
    }

    public function isStaffOnline(){
        return Cache::has('user-is-online-' . $this->id);
    }
}
