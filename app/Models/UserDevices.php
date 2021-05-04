<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDevices extends Model
{
    use HasFactory;
    protected $fillable = [
        'device_name',
        'user_id',
        'device_id',
        'lat',
        'lng'
    ];
}
