<?php

use Faker\Generator as Faker;
use App\Step;

$factory->define(App\Work::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'step_id' => Step::all()->random()->id,
        'iscomplete' => $faker->randomElement($array = array(1, 0)),
    ];
});


