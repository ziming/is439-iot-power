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
        'port' => $faker->randomElement(['A1', 'A2', 'A3', 'A4']),
        'smart_bin_id' => 1
    ];
});

$factory->define(App\PowerSensorLog::class, function (Faker\Generator $faker) {
    return [
        'power_sensor_id' => rand(1, 3),
        'measurement_taken_datetime' => $faker->dateTimeBetween('-1 months', 'now'),

        // 0 to 5
        'amp_value' => $faker->randomFloat(4, 0, 5)
    ];
});

$factory->define(App\SmartBin::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->unique()->company,
        'latitude' =>  $faker->latitude ,
        'longitude' =>  $faker->longitude ,
    ];
});