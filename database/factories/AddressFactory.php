<?php

use Faker\Generator as Faker;

$factory->define(App\Address::class, function (Faker $faker) {
    return [
        'street_number'     => $faker->randomNumber(3),
        'street_type'       => $faker->streetPrefix(),
        'street_name'       => $faker->streetName(),
        'street_complement' => null,
        'zip'               => $faker->postcode(),
        'city'              => $faker->city(),
        'created_by'        => 1,
        'updated_by'        => 1
    ];
});
