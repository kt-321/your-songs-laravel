<?php

use Faker\Generator as Faker;

$factory->define(App\Song::class, function (Faker $faker) {
    return [
        "user_id" => function(){
            return factory(App\User::class)->create()->id;  
        },
        "title" => $faker->name,
        "artist_name" => $faker->name,
        "music_age" => $faker->randomElement([1970, 1980, 1990, 2000, 2010]),
    ];
});
