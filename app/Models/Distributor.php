<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_name',
        'email',
        'address',
        'phone',
        'user_id',
        'created_by',
        'created_at','updated_at'
    ];
    protected $casts = [
        'address' => 'array',
        'phone' => 'array',
    ];
    public function resellers(){
        return $this->belongsTo('App\Models\Reseller','id','distributor_id');
    }
}
