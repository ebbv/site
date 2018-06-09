<?php

use Faker\Generator as Faker;

$factory->define(App\Phone::class, function (Faker $faker) {
    return [
        'user_id'   => function () {
            return factory('App\User')->create()->id;
        },
        'number'    => '02.02.02.02.02',
        'type'      => 'fixe',
        'created_by'=> 1,
        'updated_by'=> 1
    ];
});