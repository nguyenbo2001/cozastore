<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\ProductSize;
use Faker\Generator as Faker;

$factory->define(ProductSize::class, function (Faker $faker) {
    $name = $faker->unique()->randomLetter();
    $slug = str_slug($name, '-');
    return [
        'name' => $name,
        'slug' => $slug,
        'order' => $faker->randomDigit()
    ];
});
