<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(2),
        'type' => 'article',
        'article_id' => \App\Models\Articles::all()->random()->id,
        'question_id' => \App\Models\QaQuestion::all()->random()->id,
    ];
});
