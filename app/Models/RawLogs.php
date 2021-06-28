<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawLogs extends Model
{
    use HasFactory;
    protected $table = 'raw_data';
    protected $fillable = [
        'serial_number',
        'log_dt',
        'cycle',
        'step',
        'step_run_sec',
        'pae_volt',
        'tpv',
        'c_flow',
        'ec',
        'alarm',
        'w_temp',
        'c_temp',
        'pressure',
        'aov',
        'input',
        'output',
        'created_at','updated_at'
    ];
    public function device(){
        return $this->belongsTo('App\Models\Device','serial_number','serial_number');
    }
}
