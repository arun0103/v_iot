<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceVolumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_volumes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('device_id');
            $table->date('date');
            $table->integer('daily_volume');
            $table->integer('monthly_volume');
            $table->integer('total_volume');
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
        Schema::dropIfExists('device_volumes');
    }
}
