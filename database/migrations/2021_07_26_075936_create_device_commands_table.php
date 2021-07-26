<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceCommandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_commands', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('device_id');
            $table->string('command');
            $table->timestamp('device_read_at')->nullable();
            $table->timestamp('device_executed_at')->nullable();
            $table->string('device_response_data',20)->nullable();
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
        Schema::dropIfExists('device_commands');
    }
}
