<?php

use Faker\Generator as Faker;

$factory->define(App\Address::class, function (Faker $faker) {
    return [
        'street_info'       => $faker->streetAddress(),
        'street_complement' => '',
        'zip'               => str_replace(' ', '', $faker->postcode()),
        'city'              => $faker->city()
    ];
});
