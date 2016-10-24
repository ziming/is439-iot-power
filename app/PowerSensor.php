<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PowerSensor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'port', 'smart_bin_id'
    ];

    public function smartBin() {
        return $this->belongsTo(SmartBin::class);
    }

}
