<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Post;
use Ausi\SlugGenerator\SlugGenerator;
use DavidBadura\FakerMarkdownGenerator\FakerProvider as MarkdownFaker;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $faker->addProvider(new MarkdownFaker($faker));
    $slug = new SlugGenerator;

    $title = $faker->sentence;

    return [
        'slug' => $slug->generate($title.'-'.random_int(100, 100000)),
        'title' => $title,
        'body' => $faker->markdown(),
        'summary' => $faker->paragraph
    ];
});
