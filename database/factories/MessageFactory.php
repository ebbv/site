<?php

use Faker\Generator as Faker;

$factory->define(App\Message::class, function (Faker $faker) {
    return [
        'user_id'   => function () {
            return factory('App\User')->create()->id;
        },
        'title'     => $faker->sentence,
        'passage'   => 'Genèse 1.1',
        'url'       => str_random(15),
        'date'      => $faker->date
    ];
});
