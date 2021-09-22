<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string("serial_number")->unique();
            $table->string("device_number")->unique();
            $table->bigInteger("model_id")->nullable();
            $table->decimal('lat',10,7)->nullable();
            $table->decimal('lng',10,7)->nullable();
            $table->string("firmware");
            $table->date("manufactured_date")->nullable();
            $table->integer("reseller_id")->nullable();
            $table->string('device_name')->nullable();
            $table->bigInteger("created_by");
            $table->timestamp("last_online_at")->nullable();
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
        Schema::dropIfExists('devices');
    }
}
