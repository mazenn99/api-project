<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Favorite::class, function (Faker $faker) {
    return [
        'article_id' => \App\Models\Articles::all()->random()->id,
        'user_id'    => \App\User::all()->random()->id,
        'readed'     => 0,
    ];
});
