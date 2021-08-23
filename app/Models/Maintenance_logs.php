<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance_logs extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'device_id',
        'type',
        'value',
        'maintained_by',
        'created_at','updated_at'
    ];
}
