<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use App\User;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    $user_ids = User::all()->pluck('id');
    return [
        'title'       => $faker->sentence(6),
        'content'     => $faker->paragraph(10),
        'user_id'     => $user_ids->random(),
        'cover'       => 'http://image.lollipop.work/storage/image.jpg',
        'description' => $faker->realText(rand(10, 20)),
    ];
});
