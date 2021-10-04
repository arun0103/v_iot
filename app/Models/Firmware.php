<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Firmware extends Model
{
    use HasFactory;
    protected $table = 'firmwares';
    protected $fillable =['file_name','model_id','description','uploaded_by','created_at'];

    public function model(){
        return $this->belongsTo('App\Models\Models','model_id','id');
    }
    public function uploader(){
        return $this->belongsTo('App\Models\User','uploaded_by','id');
    }
}
