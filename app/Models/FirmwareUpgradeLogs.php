<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirmwareUpgradeLogs extends Model
{
    use HasFactory;
    protected $table = 'firmware_upgrade_logs';
    protected $fillable =['id','device_id','old_firmware','new_firmware','status','upgraded_by','created_at'];

    public function upgrader(){
        return $this->hasOne('App\Models\User','upgraded_by','id');
    }
}
