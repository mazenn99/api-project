<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Comment::class, function (Faker $faker) {
    return [
        'comment' => $faker->sentence,
        'user_id' => \App\User::all()->random()->id,
        'article_id' => \App\Models\Articles::all()->random()->id,
        'readed' => 0,
    ];
});
