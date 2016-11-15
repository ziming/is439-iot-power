<?php
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private $tables = [
        'smart_bins',
        'power_sensors',
//        'migrations',
        'power_sensor_logs',
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->cleanDatabase();
        $this->call(SmartBinsTableSeeder::class);
        $this->call(PowerSensorsTableSeeder::class);
//        $this->call(PowerSensorLogsTableSeeder::class);
    }
    private function cleanDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        foreach ($this->tables as $tableName) {
            DB::table($tableName)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}