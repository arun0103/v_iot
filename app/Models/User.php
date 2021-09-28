<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\UserProfile;
use App\Models\Reseller;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email','address','mobile','last_login',
        'password',
        'role',
        'avatar',
        'reseller_id',
        'created_by',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userDevices(){
        return $this->hasMany('App\Models\UserDevices','user_id');
    }
    public function profile(){
        return $this->hasOne('App\Models\UserProfile','user_id');
    }
    public function reseller(){
        return $this->belongsTo('App\Models\Reseller','reseller_id', 'id');
    }
    public function created_devices(){
        return $this->hasMany('App\Models\Device','created_by','id');
    }
    public function created_resellers(){
        return $this->hasMany('App\Models\Reseller', 'created_by','id');
    }
}
