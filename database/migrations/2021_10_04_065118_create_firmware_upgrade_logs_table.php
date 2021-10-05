<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirmwareUpgradeLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firmware_upgrade_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('device_id');
            $table->string('old_firmware')->nullable();
            $table->string('new_firmware');
            $table->boolean('status')->default(0);
            $table->bigInteger('upgraded_by');
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
        Schema::dropIfExists('firmware_upgrade_logs');
    }
}
