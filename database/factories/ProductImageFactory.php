<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\ProductImage;
use Faker\Generator as Faker;

$factory->define(ProductImage::class, function (Faker $faker) {
    return [
        'product_image' => 'images/product-01.jpg',
        'order' => $faker->randomDigit()
    ];
});
