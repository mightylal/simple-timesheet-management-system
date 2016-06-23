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

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->userName,
        'password' => bcrypt(str_random(10)),
        'regularRate' => $faker->numberBetween(50, 200),
        'overtimeRate' => $faker->numberBetween(100, 300),
    ];
});

$factory->define(App\Models\Time::class, function (Faker\Generator $faker) {
    return [
        'regularHours' => $faker->numberBetween(1, 12),
        'overtimeHours' => $faker->numberBetween(1, 6),
    ];
});
