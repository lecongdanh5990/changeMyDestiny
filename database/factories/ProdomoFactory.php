<?php

use Faker\Generator as Faker;

$factory->define(App\Prodpmo::class, function (Faker $faker) {
    return [
        'quantity' => $faker->randomFloat($nbMaxDecimals = 1, $min = 0, $max = 30),
    ];
});
