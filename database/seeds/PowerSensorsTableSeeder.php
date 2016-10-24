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
        factory(App\PowerSensor::class, 50)->create();
    }
}