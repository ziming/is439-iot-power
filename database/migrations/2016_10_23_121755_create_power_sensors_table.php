<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('name')->unique();

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
