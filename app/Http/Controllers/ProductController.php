<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductCategory;
use App\ProductSize;
use App\ProductColor;
use Illuminate\Pagination\Paginator;
use Session;

class ProductController extends Controller
{
    public function index() {
        $products = Product::paginate(post_per_page);
        if (request()->get('sort') || request()->get('price') || request()->get('color')) {
            $sort = request()->get('sort');
            $price = request()->get('price');
            $color = request()->get('color');
            if (isset($color)) {
                $color_id = ProductColor::where('slug', $color)->first();
            }
            switch($sort) {
                case 'popularity':
                    if (isset($price) && array_key_exists($price, array_sort_price) && $price != 'all') {
                        $price_arr = explode('-', $price);
                        if (isset($price_arr[0]) && isset($price_arr[1])) {
                            $products = Product::where('price', '>', $price_arr[0])->where('price', '<', $price_arr[1])->orderBy('view_count', 'desc')->paginate(post_per_page);
                        } else {
                            $products = Product::where('price', '>', $price_arr[0])->orderBy('view_count', 'desc')->paginate(post_per_page);
                        }
                    } else {
                        $products = Product::orderBy('view_count', 'desc')->paginate(post_per_page);
                    }
                    break;
                case 'newness':
                    if (isset($price) && array_key_exists($price, array_sort_price) && $price != 'all') {
                        $price_arr = explode('-', $price);
                        if (isset($price_arr[0]) && isset($price_arr[1])) {
                            $products = Product::where('price', '>', $price_arr[0])->where('price', '<', $price_arr[1])->orderBy('id', 'desc')->paginate(post_per_page);
                        } else {
                            $products = Product::where('price', '>', $price_arr[0])->orderBy('id', 'desc')->paginate(post_per_page);
                        }
                    } else {
                        $products = Product::orderBy('id', 'desc')->paginate(post_per_page);
                    }
                    break;
                case 'price_asc':
                    if (isset($price) && array_key_exists($price, array_sort_price) && $price != 'all') {
                        $price_arr = explode('-', $price);
                        if (isset($price_arr[0]) && isset($price_arr[1])) {
                            $products = Product::where('price', '>', $price_arr[0])->where('price', '<', $price_arr[1])->orderBy('price', 'ASC')->paginate(post_per_page);
                        } else {
                            $products = Product::where('price', '>', $price_arr[0])->orderBy('price', 'ASC')->paginate(post_per_page);
                        }
                    } else {
                        $products = Product::orderBy('price', 'ASC')->paginate(post_per_page);
                    }
                    break;
                case 'price_desc':
                    if (isset($price) && array_key_exists($price, array_sort_price) && $price != 'all') {
                        $price_arr = explode('-', $price);
                        if (isset($price_arr[0]) && isset($price_arr[1])) {
                            $products = Product::where('price', '>', $price_arr[0])->where('price', '<', $price_arr[1])->orderBy('price', 'DESC')->paginate(post_per_page);
                        } else {
                            $products = Product::where('price', '>', $price_arr[0])->orderBy('price', 'DESC')->paginate(post_per_page);
                        }
                    } else {
                        $products = Product::orderBy('price', 'DESC')->paginate(post_per_page);
                    }
                    break;
                default:
                    if (isset($price) && array_key_exists($price, array_sort_price) && $price != 'all') {
                        $price_arr = explode('-', $price);
                        if (isset($price_arr[0]) && isset($price_arr[1])) {
                            $products = Product::where('price', '>', $price_arr[0])->where('price', '<', $price_arr[1])->paginate(post_per_page);
                        } else {
                            $products = Product::where('price', '>', $price_arr[0])->paginate(post_per_page);
                        }
                    }
                    break;

            }
        }
        if (isset($color_id)) {
            $collect_array_product_id = $products->filter(function($value, $key) use ($color_id) {
                $array_product_color_id = explode('/', $value->array_product_color_id);
                if (in_array($color_id->id, $array_product_color_id))
                    return $value->id;
            });
            $array_product_id = [];
            foreach ($collect_array_product_id as $product_id) {
                array_push($array_product_id, $product_id->id);
            }
            $products = Product::whereIn('id', $array_product_id)->paginate(post_per_page);
        }
        $product_categories = ProductCategory::all();
        $product_sizes = ProductSize::all();
        $product_colors = ProductColor::all();

        return view('products.index', compact('products', 'product_categories', 'product_sizes', 'product_colors'));
    }

    public function modalProduct(Product $product) {
        $view_count = $product->view_count + 1;
        $product->update(['view_count' => $view_count]);
        $product_categories = ProductCategory::all();
        $product_sizes = ProductSize::all();
        $product_colors = ProductColor::all();
        return view('products.modal', compact('product', 'product_sizes', 'product_colors', 'product_categories'));
    }

    public function loadMore($current_page) {
        $current_page += 1;
        Paginator::currentPageResolver(function() use ($current_page) {
            return $current_page;
        });
        $products = Product::paginate(post_per_page);
        return view('products.load-more', compact('products'));
    }

    public function addCart(Product $product, Request $request) {
        $slug_name = str_slug($product->name);
        $cart = Session::get('cart');
        if (isset($cart[$slug_name])):
            if (isset($request->cartProductCount) && $cart[$slug_name]['product_count'] != $request->cartProductCount):
                $cart[$slug_name] = [
                    'product_name' => $product->name,
                    'product_size_id' => $request->cartSizeID,
                    'product_color_id' => $request->cartColorID,
                    'product_count' => $request->cartProductCount,
                    'price' => $product->price,
                    'image' => $product->images->first()->product_image,
                    ];
            endif;
        else:
            $cart[$slug_name] = [
                                'product_name' => $product->name,
                                'product_size_id' => $request->cartSizeID,
                                'product_color_id' => $request->cartColorID,
                                'product_count' => $request->cartProductCount,
                                'price' => $product->price,
                                'image' => $product->images->first()->product_image,
                                ];
        endif;
        Session::put('cart', $cart);
        if (isset($cart[$slug_name]) && $cart[$slug_name]['product_count'] == 0) {
            Session::forget('cart.'.$slug_name);
        }
        Session::save();
    }

    public function removeCart($product, Request $request) {
        $cart = Session::get('cart');
        if (isset($cart[$product])) {
            Session::forget('cart.'.$product);
        }
        Session::save();
    }
}
