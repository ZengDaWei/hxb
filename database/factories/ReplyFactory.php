<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\Reply;
use Faker\Generator as Faker;

$factory->define(Reply::class, function (Faker $faker) {
    $user_ids    = User::all()->pluck('id');
    $comment_ids = Comment::all()->pluck('id');
    return [
        'content'    => $faker->realText(rand(10, 20)),
        'user_id'    => $user_ids->random(),
        'comment_id' => $comment_ids->random(),
    ];
});
