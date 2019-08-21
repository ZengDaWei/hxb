<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use App\Comment;
use App\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    $user_ids    = User::all()->pluck('id');
    $article_ids = Article::all()->pluck('id');
    return [
        'content'          => $faker->realText(rand(10, 20)),
        'commentable_type' => 'articles',
        'commentable_id'   => $article_ids->random(),
        'user_id'          => $user_ids->random(),
    ];
});
