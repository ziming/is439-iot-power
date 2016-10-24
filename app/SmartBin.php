<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmartBin extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'latitude', 'longitude',
    ];

    public function powerSensors() {
        return $this->hasMany(PowerSensor::class);
    }

}
