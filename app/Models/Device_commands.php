<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device_commands extends Model
{
    use HasFactory;
    protected $table = 'device_commands';
    protected $fillable = [
        'id',
        'device_id',
        'command',
        'device_read_at',
        'device_executed_at',
        'device_response_data',
        'created_at','created_by',
        'updated_at',
    ];
    public function device(){
        return $this->hasOne('App\Models\Device','id','device_id');
    }
    public function creatorDetails(){
        return $this->hasOne('App\Models\User','id','created_by');
    }
}
