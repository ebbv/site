<?php

use Faker\Generator as Faker;

$factory->define(App\Message::class, function (Faker $faker) {
    return [
        'user_id'   => $faker->randomElement(range(2, 6)),
        'title'     => $faker->sentence,
        'passage'   => 'Genèse 1.1',
        'url'       => str_random(15),
        'date'      => $faker->date
    ];
});
