<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Post;
use DavidBadura\FakerMarkdownGenerator\FakerProvider as MarkdownFaker;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    $faker->addProvider(new MarkdownFaker($faker));
    $title = $faker->sentence;

    return [
        'slug' => Str::slug($title.'-'.random_int(100, 100000)),
        'title' => $title,
        'body' => $faker->markdown(),
        'summary' => $faker->paragraph
    ];
});
