<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLatestLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('latest_logs', function (Blueprint $table) {
            $table->id();
            $table->string('serial_number',9)->unique();
            $table->timestamp('log_dt');
            $table->integer('cycle');
            $table->integer('step');
            $table->integer('step_run_sec');
            $table->float('pae_volt');
            $table->double('tpv');
            $table->float('c_flow');
            $table->integer('ec');
            $table->integer('alarm');
            $table->float('w_temp');
            $table->float('c_temp');
            $table->float('pressure');
            $table->float('aov');
            $table->integer('input');
            $table->integer('output');
            $table->string('percentage_recovery',3);
            $table->string('mode',1);
            $table->integer('live_ec')->nullable();
            $table->float('pae_current')->nullable();
            $table->integer('last_alarmed_cycle')->nullable();
            $table->timestamps();

            // $table->unique(['serial_number']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('latest_logs');
    }
}
