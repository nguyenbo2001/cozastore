<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(App\ProductCategory::class, 10)->create();
        factory(App\ProductSize::class, 10)->create();
        factory(App\ProductColor::class, 10)->create();
        factory(App\Product::class, 50)->create()->each(function($product) {
            $product->images()->saveMany(factory(App\ProductImage::class, 5)->make());
        });
    }
}
