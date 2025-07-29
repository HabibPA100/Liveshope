<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $categories = Category::with('childrenRecursive')->whereNull('parent_id')->get();

        return view('frontend.index', compact('categories'));
});