<?php

use Faker\Generator as Faker;

$factory->define(App\Address::class, function (Faker $faker) {
    return [
        'user_id'           => function () {
            return factory('App\User')->create()->id;
        },
        'street_number'     => null,
        'street_type'       => 'rue',
        'street_name'       => '',
        'street_complement' => null,
        'zip'               => 12345,
        'city'              => '',
        'created_by'        => 1,
        'updated_by'        => 1
    ];
});
