<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PowerSensorLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'power_sensor_id', 'amp_value', 'measurement_taken_datetime'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'measurement_taken_datetime'
    ];

    public function powerSensor() {
        return $this->belongsTo(PowerSensor::class);
    }

}
