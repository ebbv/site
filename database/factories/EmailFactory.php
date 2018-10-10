<?php

use Faker\Generator as Faker;

$factory->define(App\Email::class, function (Faker $faker) {
    return [
        'address'   => $faker->email,
        'type'      => $faker->randomElement(['principal', 'secondaire'])
    ];
});
