<?php

use Faker\Generator as Faker;

$factory->define(App\Phone::class, function (Faker $faker) {
    return [
        'number'    => $faker->phoneNumber,
        'type'      => $faker->randomElement(['fixe', 'portable'])
    ];
});
