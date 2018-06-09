<?php

use Faker\Generator as Faker;

$factory->define(App\Role::class, function (Faker $faker) {
    return [
        'name'      => $faker->word,
        'created_by'=> 1,
        'updated_by'=> 1
    ];
});
