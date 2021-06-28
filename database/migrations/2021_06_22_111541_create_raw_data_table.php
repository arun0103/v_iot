<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRawDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_data', function (Blueprint $table) {
            $table->id();
            $table->string('serial_number');
            $table->timestamp('log_dt');
            $table->integer('cycle');
            $table->integer('step');
            $table->integer('step_run_sec');
            $table->float('pae_volt');
            $table->float('tpv');
            $table->float('c_flow');
            $table->integer('ec');
            $table->integer('alarm');
            $table->float('w_temp');
            $table->float('c_temp');
            $table->float('pressure');
            $table->float('aov');
            $table->integer('input');
            $table->integer('output');
            $table->timestamps();

            $table->unique(['serial_number', 'log_dt']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('raw_data');
    }
}
