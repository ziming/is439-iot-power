<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePowerSensorLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('power_sensor_logs', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('power_sensor_id')->unsigned();
            $table->foreign('power_sensor_id')->references('id')->on('power_sensors');

            $table->timestamp('measurement_taken_datetime');

            $table->integer('amp_value');


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
        Schema::dropIfExists('power_sensor_logs');
    }
}
