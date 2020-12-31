<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\qa_votes_answer::class, function (Faker $faker) {
    return [
        'qa_answer_id' => \App\Models\qa_answers::all()->random()->id,
        'user_id'      => \App\User::all()->random()->id,
    ];
});
