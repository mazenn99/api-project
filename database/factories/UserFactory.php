<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'fullName' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('mazenmazen'),
        'remember_token' => Str::random(10),
        'twitter' => $faker->name,
        'bio' => $faker->sentence,
        'askfm' => $faker->name,
        'linkedin' => $faker->name,
        'imgPath' => $faker->imageUrl(),
        'facebookID' => 1,
        'twitterID' => 1,
        'facebook' => $faker->name,
        'user_university' => $faker->name,
        'user_specialist' => $faker->name,
        'user_region' => $faker->name,
        'agreement' => 1,
        'group' => 1,
        'user_level' => 5,
    ];
});
