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
        'created_by','last_online_at',
        'created_at','updated_at'
    ];

    public function userDevices(){
        return $this->hasMany(UserDevices::class, 'device_id','id');
    }
    public function logs(){
        return $this->hasMany('App\Models\RawLogs', 'serial_number','serial_number');
    }
    public function latest_log(){
        return $this->hasOne('App\Models\RawLogs','serial_number','serial_number')->latest('log_dt');
    }
    public function device_settings(){
        return $this->hasOne('App\Models\Device_settings','device_id','id');
    }
    public function device_commands(){
        return $this->hasOne('App\Models\Device_commands','device_id','id');
    }
    public function setpoints(){
        return $this->hasOne('App\Models\Setpoints','device_id','id');
    }
    public function latest_maintenance_critic_acid(){
        return $this->hasOne('App\Models\Maintenance_critic_acid','device_id','id')->latest();
    }
    public function latest_maintenance_pre_filter(){
        return $this->hasOne('App\Models\Maintenance_pre_filter','device_id','id')->latest();
    }
    public function latest_maintenance_post_filter(){
        return $this->hasOne('App\Models\Maintenance_post_filter','device_id','id')->latest();
    }
    public function latest_maintenance_general_service(){
        return $this->hasOne('App\Models\Maintenance_general_service','device_id','id')->latest();
    }

}
