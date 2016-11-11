<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\PowerSensor::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->unique()->company,
        'port' =>  $faker->randomElement(['D1', 'D2', 'D3', 'D4']),
        'smart_bin_id' =>  function () {
//             return factory(App\SmartBin::class)->create()->id;
            return rand(1, 10);
        } ,
    ];
});

$factory->define(App\PowerSensorLog::class, function (Faker\Generator $faker) {
    return [
        'power_sensor_id' => rand(1, 50),
        'measurement_taken_datetime' => $faker->dateTimeBetween('-1 years', 'now'),
        'amp_value' => $faker->randomFloat(4, 0, 999)
    ];
});

$factory->define(App\SmartBin::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->unique()->company,
        'latitude' =>  $faker->latitude ,
        'longitude' =>  $faker->longitude ,
    ];
});

