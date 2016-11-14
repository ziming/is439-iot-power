<?php
namespace App\Transformers;

class PowerSensorTransformer extends Transformer
{

    public function transform($powerSensor)
    {
        return [
            'id' => (int)$powerSensor->id,
            'name' => $powerSensor->name,
            'port' => $powerSensor->port,
            'smart_bin_id' => (int)$powerSensor->smart_bin_id,
        ];
    }
}