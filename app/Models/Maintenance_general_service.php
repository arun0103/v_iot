<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance_general_service extends Model
{
    use HasFactory;
    protected $table = 'maintenance_general_service';
    protected $fillable =[
        'id','device_id','volume_value','maintained_by','created_at','updated_at'
    ];
    public function device(){
        return $this->belongsTo('App\Models\Device','device_id','id');
    }

}
