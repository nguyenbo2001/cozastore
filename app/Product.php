<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'code',
        'title',
        'description',
        'weight',
        'dimension',
        'material',
        'price',
        'population',
        'view_count',
        'order',
        'product_category',
        'array_product_size_id',
        'array_product_color_id'
    ];

    public static function boot() {
        parent::boot();
        static::saving(function($model) {
            $model->slug = str_slug($model->name, '-');
        });
    }

    public function images() {
        return $this->hasMany('App\ProductImage');
    }

    public function category() {
        return $this->belongsTo("App\ProductCategory", 'product_category_id');
    }
}
