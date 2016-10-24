<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePowerSensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('power_sensors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            // which raspberry pi port
            $table->string('port');

            $table->integer('smart_bin_id')->unsigned();
            $table->foreign('smart_bin_id')->references('id')->on('smart_bins');

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
        Schema::dropIfExists('power_sensors');
    }
}
