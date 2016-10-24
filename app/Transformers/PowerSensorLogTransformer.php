<?php
namespace App\Transformers;

class PowerSensorLogTransformer extends Transformer
{

    public function transform($smartBin)
    {
        return [
            'id' => (int) $smartBin->id,
            'power_sensor_id' => (int) $smartBin->power_sensor_id,
            'amp_value' => (int) $smartBin->amp_value,
            'measurement_taken_datetime' => $smartBin->measurement_taken_datetime,
        ];
    }
}