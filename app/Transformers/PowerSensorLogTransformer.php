<?php
namespace App\Transformers;

class PowerSensorLogTransformer extends Transformer
{

    public function transform($powerSensorLog)
    {
        return [
//            'id' => (int) $powerSensorLog->id,
            'power_sensor_id' => (int)$powerSensorLog->power_sensor_id,
            'amp_value' => (double)$powerSensorLog->amp_value,
            'measurement_taken_datetime' => $powerSensorLog->measurement_taken_datetime->toDateTimeString(),
        ];
    }
}