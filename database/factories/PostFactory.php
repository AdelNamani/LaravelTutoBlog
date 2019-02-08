<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title'=>$faker->unique()->company,
        'description'=>$faker->realText(5000),
        'user_id'=>$faker->numberBetween(1,12)
    ];
});
