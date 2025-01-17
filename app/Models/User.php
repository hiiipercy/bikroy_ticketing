<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     public const ADMIN = 1;
     public const USER = 2;

    protected $fillable = [
        'name',
        'email',
        'phone_no',
        'role_type',
        'password',
        'status',
        'image'
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

    public function ticket(){
        return $this->hasMany(Ticket::class,'user_id','id')->withDefault(['name'=>'N/A']);
    }

    public function feedback(){
        return $this->hasMany(Ticket::class,'user_id','id')->withDefault(['name'=>'N/A']);
    }

    // public function ticket(){
    //     return $this->hasMany(Ticket::class,'category_id','id');
    // }

    
}
