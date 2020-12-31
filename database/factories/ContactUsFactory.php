<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Contact::class, function (Faker $faker) {
    return [
        'comingfrom' => $faker->email,
        'subject' => $faker->sentence(1),
        'message' => $faker->sentence,
    ];
});
