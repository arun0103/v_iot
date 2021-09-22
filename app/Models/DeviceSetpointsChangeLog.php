<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceSetpointsChangeLog extends Model
{
    use HasFactory;
    protected $table = 'device_setpoints_change_logs';
    protected $fillable = [
        'device_id','parameter','old_value', 'new_value', 'changed_by','is_viewed','created_at','updated_at'
    ];

    public function changerDetails(){
        return $this->hasOne('App\Models\User','id','changed_by');
    }
}
