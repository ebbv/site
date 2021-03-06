<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'first_name'    => $faker->firstName,
        'last_name'     => $faker->lastName,
        'username'      => $faker->userName,
        'password'      => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token'=> \Illuminate\Support\Str::random(10)
    ];
});
