<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    protected $fillable = [
        'model',
        'serial_number',
        'manufactured_date',
        'installation_date',
        'reseller_id',
        'is_under_warranty',
        'created_by'
    ];

    public function associatedUsers(){
        return $this->hasMany(UserDevices::class);
    }

}
