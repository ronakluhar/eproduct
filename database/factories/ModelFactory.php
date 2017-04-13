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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Admin;
use App\PropertyFieldType;
use App\PropertyActionType;
use App\Language;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'phone' => $faker->numberBetween(100000000,999999999),
        'gender' => 'male',
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt(User::DEFAULT_PASSWORD),
        'remember_token' => str_random(10),
        'deleted' => '1',
    ];
});

$factory->define(App\Admin::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'phone' => $faker->numberBetween(100000000,999999999),
        'gender' => 'male',
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt(User::DEFAULT_PASSWORD),
        'remember_token' => str_random(10),
        'deleted' => '1',
    ];
});

$factory->define(App\PropertyFieldType::class, function (Faker\Generator $faker) {
    return [
        'pft_name' => $faker->firstName,
        'pft_slug' => $faker->lastName,
        'status' => '1',
    ];
});

$factory->define(App\PropertyActionType::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'slug' => $faker->lastName,
        'status' => '1',
    ];
});

$factory->define(App\Language::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'short_name' => $faker->lastName,
        'code' => $faker->numberBetween(2,5),
        'is_active' => '1'
    ];
});