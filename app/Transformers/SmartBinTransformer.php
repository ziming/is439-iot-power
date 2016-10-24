<?php
namespace App\Transformers;
class SmartBinTransformer extends Transformer
{

    /**
     * @param $smartBin
     * @return array
     */
    public function transform($smartBin)
    {
        return [
            'id' => (int) $smartBin->id,
            'name' => $smartBin->name,
            'latitude' => $smartBin->latitude,
            'longitude' => $smartBin->longitude,
            'power_sensor_ids' => $smartBin->powerSensors()->pluck('id'),

        ];
    }
}