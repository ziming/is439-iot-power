<?php
use Illuminate\Database\Seeder;

class PowerSensorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // first 3 power sensor belongs to bin 1
        factory(App\PowerSensor::class, 3)->create([
            'smart_bin_id' => 1
        ]);

        factory(App\PowerSensor::class, 50)->create();


    }
}