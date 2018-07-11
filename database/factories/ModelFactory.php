<?php

use Faker\Factory as _Faker;

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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;
    $_faker = _Faker::create();
    return [
        'name'              => $_faker->name,
        'lastname'          => $_faker->lastName,
        'email'             => $_faker->email,
        'password'          => bcrypt($_faker->word),
        'level'             => $_faker->numberBetween(0,3),
        'remember_token'    => str_random(10),
    ];
});
