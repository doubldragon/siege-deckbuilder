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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Card::class, function (Faker\Generator $faker) {
    static $password;

    return [
        
        'isMonarch' => $faker->boolean,
        'name' => $faker->name,
        'deck_points' => rand(1,5),
        'type_id' => rand(1,7),
        'cost' => rand(1,8),
        'action' => $faker->word,
        'effect' => $faker->word,
        'flavor_text' => $faker->word,
    ];

});

