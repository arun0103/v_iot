<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceSettingsLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_settings_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('device_id');
            $table->string('parameter');
            $table->decimal('old_value');
            $table->decimal('new_value');
            $table->bigInteger('changed_by');
            $table->boolean('is_viewed')->nullable();
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
        Schema::dropIfExists('device_settings_logs');
    }
}
