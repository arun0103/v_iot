<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setpoints extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','device_id','pure_EC_target','prepurify_time','purify_time','waste_time','HF_waste_time'
        ,'CIP_dose','CIP_dose_total','CIP_flow_total','CIP_flow_flush','CIP_flow_rec','CIP_flush_time'
        ,'WV_check_time','wait_HT_time','p_flow_target','low_flow_purify_alarm','low_flow_waste_alarm',
        'CIP_cycles','temperature_alarm','max_CIP_prt','pump_p_factor','dynamic_p_factor','p_max_volt',
        'w_max_volt','w_value','flow_k_factor','volume_unit','bypass_option','start_pressure','stop_pressure',
        'bypass_pressure','CIP_pressure','wait_time_before_CIP',
        'created_at','updated_at'
    ];

    public function device(){
        return $this->belongsTo('App\Models\Device','device_id','id');
    }

}
