<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Articles;
use Faker\Generator as Faker;

$factory->define(Articles::class, function (Faker $faker) {
    return [
        'user_id' => \App\User::all()->random()->id,
        'environment' => $faker->sentence,
        'specialize' => $faker->sentence,
        'companyName' => $faker->sentence,
        'requirements' => $faker->sentence,
        'contactRule' => $faker->sentence,
        'period' => 2,
        'description' => $faker->sentence,
        'category' => 'summer',
        'title' => $faker->sentence,
        'numLikes' => 0,
        'tags' => $faker->sentence(1),
        'draft' => 0,
        'view_count' => 0,
        'picture' => $faker->imageUrl(),
    ];
});
