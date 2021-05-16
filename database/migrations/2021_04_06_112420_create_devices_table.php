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
            $table->string("model")->nullable();
            $table->date("manufactured_date");
            $table->date("installation_date");
            $table->integer("reseller_id")->nullable();
            $table->boolean("is_under_warranty")->default(true);
            $table->integer("created_by");
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
