<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductManageController extends Controller
{
    // সকল প্রোডাক্ট দেখাবে (Admin সব দেখবে)
    public function index()
    {
        return view('frontend.admin.products.new-product');
    }
}