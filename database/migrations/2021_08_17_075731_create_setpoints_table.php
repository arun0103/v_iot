<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetpointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setpoints', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('device_id')->unique();
            $table->integer('pure_EC_target')->nullable();
            $table->integer('prepurify_time')->nullable();
            $table->integer('purify_time')->nullable();
            $table->integer('waste_time')->nullable();
            $table->integer('HF_waste_time')->nullable();
            $table->integer('CIP_dose')->nullable();
            $table->integer('CIP_dose_rec')->nullable();
            $table->integer('CIP_dose_total')->nullable();
            $table->integer('CIP_flow_total')->nullable();
            $table->integer('CIP_flow_flush')->nullable();
            $table->integer('CIP_flow_rec')->nullable();
            $table->integer('CIP_flush_time')->nullable();
            $table->integer('WV_check_time')->nullable();
            $table->integer('wait_HT_time')->nullable();
            $table->float('p_flow_target')->nullable();
            $table->float('low_flow_purify_alarm')->nullable();
            $table->float('low_flow_waste_alarm')->nullable();
            $table->integer('CIP_cycles')->nullable();
            $table->integer('temperature_alarm')->nullable();
            $table->integer('max_CIP_prt')->nullable();
            $table->float('pump_p_factor')->nullable();
            $table->float('dynamic_p_factor')->nullable();
            $table->float('p_max_volt')->nullable();
            $table->float('w_max_volt')->nullable();
            $table->float('w_value')->nullable();
            $table->integer('flow_k_factor')->nullable();
            $table->integer('volume_unit')->nullable(); // 0 = liter , 1 = gallon
            $table->integer('bypass_option')->nullable(); // not in DiUse / DiEntry 0 = internal, 1 = ext NC, 2 = Ext No
            $table->float('start_pressure')->nullable();
            $table->float('stop_pressure')->nullable();
            $table->float('bypass_pressure')->nullable();
            $table->float('CIP_pressure')->nullable();
            $table->integer('wait_time_before_CIP')->nullable();
            $table->integer('bypass_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setpoints');
    }
}
