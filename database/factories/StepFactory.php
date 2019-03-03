<?php

use Faker\Generator as Faker;
use App\Mission;

$factory->define(App\Step::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'mission_id' => Mission::all ()->random()->id,
        'startday' => $faker->date($format = 'Y-m-d', $max = '2025-12-31'),
        'endday'=>$faker->date($format = 'Y-m-d', $max = '2025-12-31') ,
    ];
});
