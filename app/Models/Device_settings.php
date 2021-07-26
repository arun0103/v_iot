<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device_settings extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'critic_acid',
        'pre_filter',
        'post_filter',
        'general_service',

    ];
    public function device(){
        return $this->belongsTo('App\Models\Device','id','device_id');
    }
}
