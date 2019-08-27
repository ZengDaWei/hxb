<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Follow;
use Faker\Generator as Faker;

$factory->define(Follow::class, function (Faker $faker) {
    $user_ids = User::all()->pluck('id');
    $user_id  = User::all()->pluck('id')->random();
    return [
        'user_id'       => $user_id,
        'followed_type' => 'users',
        'followed_id'   => $user_ids->forget($user_id),
    ];
});
