<?php

use Faker\Generator as Faker;
use App\Mission;

$factory->define(App\Step::class, function (Faker $faker) {
    $mission_id = Mission::all()->random()->id;
    
    $mission= Mission::find($mission_id);
    $lastStep = $mission->steps()
        ->orderBy('id', 'desc')
        ->take(1)
        ->get(['endday']);

    if (count($lastStep)) {
        $startday = $lastStep[0]->endday;
        $date = new \DateTimeImmutable($startday);
        $date = $date->modify('+1 day');
        $startday = $date->format('Y-m-d');
    }
    else {
        $startday = $faker->date($format = 'Y-m-d', $max = $mission->endday);
    }

    $tempsEndday = $faker->dateTimeBetween($startDate = $startday, $endDate = $mission->endday, $timezone = null);
    $endday = $tempsEndday->format('Y-m-d');
    return [
        'name' => $faker->name,
        'mission_id' => $mission_id,
        'iscomplete' => $faker->randomElement($array = array(1, 0)),
        'startday' => $startday,
        'endday' => $endday,
    ];
});
