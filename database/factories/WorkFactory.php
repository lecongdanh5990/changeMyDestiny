<?php

use Faker\Generator as Faker;
use App\Mission;

$factory->define(App\Work::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'mission_id' => Mission::all ()->random()->id,
        'priority'=> $faker->randomElement($array = array(1,2,3,4)),
        'iscomplete' => $faker->randomElement($array = array(1, 0)),
    ];
});
