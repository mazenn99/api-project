<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\qa_answers::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence,
        'correct'     => 2,
        'qa_question_id' => \App\Models\QaQuestion::all()->random()->id,
        'user_id' => \App\User::all()->random()->id,
    ];
});
