<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Blog::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->word,
        'body' => $faker->paragraph,
        'published_at' => $faker->dateTime,
        'active' => $faker->boolean,
        'user_id' => 1,
        'created_at' => $faker->date,
    ];
});
