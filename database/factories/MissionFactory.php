<?php

use Faker\Generator as Faker;

$factory->define(App\Mission::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'iscomplete'=>$faker->randomElement($array = array(1,0)),
        'startday' => $faker->date($format = 'Y-m-d', $max = '2025-12-31'),
        'endday'=>$faker->date($format = 'Y-m-d', $max = '2025-12-31') ,
    ];
});
