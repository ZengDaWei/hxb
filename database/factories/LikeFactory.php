<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Like;
use Faker\Generator as Faker;

$factory->define(Like::class, function (Faker $faker) {
    $user_ids    = User::all()->pluck('id');
    $article_ids = Article::all()->pluck('id');
    return [
        'user_id'    => $user_ids->random(),
        'liked_type' => 'articles',
        'liked_id'   => $article_ids->random(),
    ];
});
