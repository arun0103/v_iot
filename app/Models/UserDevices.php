<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDevices extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'device_id',

        'device_name', 'lat', 'lng'
    ];
    public function deviceDetails(){
        return $this->belongsTo('App\Models\Device','device_id','id');
    }
}
