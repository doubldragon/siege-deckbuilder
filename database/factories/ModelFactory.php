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

    $icons = array(

            'https://png.icons8.com/crown-filled/ios7/25',
            'https://png.icons8.com/castle-filled/ios7/25',
            'https://png.icons8.com/poultry-leg-filled/ios7/25',
            'https://png.icons8.com/happy/ios7/25',    
            'https://png.icons8.com/catapult/ios7/25',
            'https://png.icons8.com/defense/androidL/24',
            'https://png.icons8.com/spy-male-filled/ios7/25 '
        );
    $type = rand(3,7);
    
    return [
        
        'isMonarch' => $faker->boolean,
        'name' => $faker->name,
        'deck_points' => rand(1,5),
        'type_id' => $type,
        'type_icon' => $icons[$type-1],
        'cost' => rand(1,8),
        'action' => $faker->sentence,
        'effect' => $faker->sentence,
        'flavor_text' => $faker->sentence,
    ];

});

