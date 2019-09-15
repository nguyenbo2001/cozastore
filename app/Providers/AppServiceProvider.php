<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use View;
use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        // View::share('array_sort_by', [
        //     'default' => 'Default',
        //     'popularity' => 'Popularity',
        //     'average_rating' => 'Average Rating',
        //     'newness' => 'Newness',
        //     'price_asc' => 'Price: Low to High',
        //     'price_desc' => 'Price: High to Low'
        // ]);
    }
}
