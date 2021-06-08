<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'profession','institution', 'phone', 'mobile','address'
    ];
    public function user(){
        return $this->belongsTo('App\Models\User','id','user_id');
    }
}
