<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\ProductColor;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(ProductColor::class, function (Faker $faker) {
    $name = $faker->unique()->name;
    $slug = Str::slug($name, '-');
    return [
        'name' => $name,
        'slug' => $slug,
        'order' => $faker->randomDigit()
    ];
});
