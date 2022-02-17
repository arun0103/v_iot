<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device_volumes extends Model
{
    use HasFactory;
    protected $table = 'device_volumes';
    protected $fillable = [
        'device_id','date','first_tpv','last_tpv','created_at','updated_at'
    ];

    public function device(){
        return $this->hasOne('App\Models\Device','id','device_id');
    }
}
