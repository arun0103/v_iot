<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDevices extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'device_id',

        'device_name','users_count', 'lat', 'lng',

    ];
    public function deviceDetails(){
        return $this->belongsTo('App\Models\Device','device_id','id');
    }
    public function userDetails(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
