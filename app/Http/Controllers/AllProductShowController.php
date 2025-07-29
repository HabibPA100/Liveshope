<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AllProductShowController extends Controller
{
    public function index(){
        
        $allProduct = Product::latest()->get();

        return view('frontend.all-product', compact('allProduct'));
    }
}
