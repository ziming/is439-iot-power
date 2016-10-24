<?php
namespace App\Transformers;

class PowerSensorTransformer extends Transformer
{

    public function transform($smartBin)
    {
        return [
            'id' => (int) $smartBin->id,
            'name' => $smartBin->name,
            'port' => $smartBin->port,
            'smart_bin_id' => (int) $smartBin->smart_bin_id,
        ];
    }
}