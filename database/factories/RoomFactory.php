<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Room;
use Faker\Generator as Faker;

$factory->define(Room::class, function (Faker $faker) {

//    do {
        $floor = $faker->numberBetween(1,6);
        $fnum = $faker->numberBetween(0,1);
        $number = $floor;
        if ($fnum == 1) {
            $number .= '10';
        } else {
            $number .= $fnum . $faker->numerify('#');
        }
//        $room  = Room::get()->where('number', $number);
//    } while ($room);



    return [

        'number' => $number,
        'floor' => $floor,
        'available' => ("no")


    ];
});
