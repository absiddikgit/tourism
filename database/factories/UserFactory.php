<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => 'Admin',
        'email' => 'admin@gmail.com',
        'password' => bcrypt('123456'), // 123456
        'is_admin' => 1,
        'status' => 1,
        'remember_token' => str_random(10),
    ];
});
