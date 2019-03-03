<?php

use Faker\Generator as Faker;
use App\Status;

$factory->define(App\Work::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'status_id' => Status::all ()->random()->id,
    ];
});
