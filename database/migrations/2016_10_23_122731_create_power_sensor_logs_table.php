<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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

            $table->timestamp('measurement_taken_datetime')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->decimal('amp_value', 20, 18);

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
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
