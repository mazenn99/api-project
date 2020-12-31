<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Qa_votes::class, function (Faker $faker) {
    return [
        'qa_question_id' => \App\Models\QaQuestion::all()->random()->id,
        'qa_answer_id'   => \App\Models\QaQuestion::all()->random()->id,
        'user_id'        => \App\User::all()->random()->id,
    ];
});
