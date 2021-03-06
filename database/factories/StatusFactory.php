<?php

use Faker\Generator as Faker;
use App\Mission;

$factory->define(App\Status::class, function (Faker $faker) {
    return [
        'content' => $faker->text,
        'tomato'=>$faker->randomElement($array = array(1,4,5,7,8)),
        'rating'=>$faker->randomElement($array = array(1,2,3,4,5)),
        'mission_id' => Mission::all()->random()->id,

    ];
});
