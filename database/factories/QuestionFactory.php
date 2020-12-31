<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\QaQuestion::class, function (Faker $faker) {
    return [
        'user_id' => \App\User::all()->random()->id,
        'title'   => $faker->sentence(2),
        'description' => $faker->sentence,
        'post_date' => date('y-m-d'),
        'views_count' => 1,
        'tags'   => $faker->sentence(1),
        'closed' => 0,
        'category' => 1,
        'points'  => 10
    ];
});
