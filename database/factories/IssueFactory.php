<?php

use Faker\Generator as Faker;

$factory->define(App\Issue::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return create(\App\User::class)->id;
        },
        'lane_id' => function() {
            return create(\App\Lane::class)->id;
        },
        'title' => $faker->sentence,
        'description' => $faker->paragraph
    ];
});
