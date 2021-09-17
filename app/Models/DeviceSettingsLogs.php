<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceSettingsLogs extends Model
{
    use HasFactory;
    protected $table = 'device_settings_logs';
    protected $fillable = [
        'id',
        'device_id',
        'parameter',
        'old_value',
        'new_value',
        'changed_by','is_viewed',
        'created_at','updated_at'
    ];
    public function device(){
        return $this->hasOne('App\Models\Device','device_id','id');
    }
    public function changerDetails(){
        return $this->hasOne('App\Models\User', 'id','changed_by');
    }
}
