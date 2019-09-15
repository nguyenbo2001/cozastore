<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\ProductCategory;
use Faker\Generator as Faker;

$factory->define(ProductCategory::class, function (Faker $faker) {
    $name = $faker->unique()->name;
    $slug = str_slug($name, '-');
    return [
        'name' => $name,
        'slug' => $slug,
        'description' => $faker->paragraph(),
        'order' => $faker->randomDigit()
    ];
});
