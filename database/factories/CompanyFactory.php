<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->prefecture,
        'website' => $faker->url,
        'email' => $faker->unique()->safeEmail
    ];
});
