<?php

use Faker\Generator as Faker;

$factory->define(App\Message::class, function (Faker $faker) {
    return [
        'user_id'   => factory(App\User::class)->create()->id,
        'title'     => $faker->sentence,
        'passage'   => 'Genèse 1.1',
        'url'       => str_random(15),
        'date'      => $faker->date
    ];
});
