<?php

use Faker\Generator as Faker;

$factory->define(App\Note::class, function (Faker $faker) {
    return [
        'description' => $faker->name,
        'rating' => $faker->numberBetween($min = 1, $max = 5),
    ];
});

