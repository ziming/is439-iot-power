<?php
use Illuminate\Database\Seeder;
class PowerSensorLogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\PowerSensorLog::class, 100)->create([
            'power_sensor_id' => rand(1, 50),
        ]);
    }
}