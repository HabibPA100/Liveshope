<?php

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $categories = Category::with('childrenRecursive')->whereNull('parent_id')->get();

        return view('frontend.index', compact('categories'));
});

Route::get('/featured-gifts', function(){
    $gifts = Product::where('is_featured', true)->get();

    return view('frontend.featured-gifts', compact('gifts'));
})->name('products.featured-gifts');
