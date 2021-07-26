<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device_commands extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'device_id',
        'command',
        'device_read_at',
        'device_executed_at',
        'device_response_data',
        'created_at',
        'updated_at',
    ];
    public function device(){
        return $this->hasOne('App\Models\Device','id','device_id');
    }
}
