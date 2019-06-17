<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use SPS\UserRole;
use Faker\Generator as Faker;

$factory->define(UserRole::class, function (Faker $faker) {
    return [
        'user_id' => rand(1, 50),
        'role_id' => rand(1, 4),
    ];
});
