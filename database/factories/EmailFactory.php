<?php

use Faker\Generator as Faker;

$factory->define(App\Email::class, function (Faker $faker) {
    return [
        'user_id'   => function () {
            return factory('App\User')->create()->id;
        },
        'address'   => $faker->email,
        'type'      => $faker->randomElement(['principal', 'secondaire']),
        'created_by'=> 1,
        'updated_by'=> 1
    ];
});
