<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Product;
use App\ProductImage;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    $name = $faker->unique()->name;
    $slug = Str::slug($name, '-');
    return [
        'name' => $name,
        'slug' => $slug,
        'code' => $faker->ean8(),
        'title' => $faker->sentence(),
        'description' => $faker->text(),
        'weight' => $faker->randomFloat(3, 0, 10),
        'dimension' => $faker->word(),
        'price' => $faker->randomFloat(2, 0, 500),
        'product_category_id' => $faker->numberBetween(1, 10),
        'array_product_size_id' => '1/2/3',
        'array_product_color_id' => '1/2/3'
    ];
});
