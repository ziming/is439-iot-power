<?php
use Illuminate\Database\Seeder;

class SmartBinsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\SmartBin::class, 10)->create();
    }
}