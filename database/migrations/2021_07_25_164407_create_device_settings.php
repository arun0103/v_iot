<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_settings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('device_id');
            $table->decimal('critic_acid')->nullable();
            $table->decimal('pre_filter')->nullable();
            $table->decimal('post_filter')->nullable();
            $table->decimal('general_service')->nullable();
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
        Schema::dropIfExists('device_settings');
    }
}
