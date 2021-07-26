<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial_number',
        'device_number',
        'model',
        'firmware',
        'installation_date',
        'reseller_id',
        'created_by',
        'created_at','updated_at'
    ];

    public function userDevices(){
        return $this->hasMany(UserDevices::class, 'device_id','id');
    }
    public function logs(){
        return $this->hasMany('App\Models\RawLogs', 'serial_number','serial_number');
    }
    public function device_settings(){
        return $this->hasOne('App\Models\Device_settings','device_id','id');
    }
    public function device_commands(){
        return $this->hasOne('App\Models\Device_commands','device_id','id');
    }

}
