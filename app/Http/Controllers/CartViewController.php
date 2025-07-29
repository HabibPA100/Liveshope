<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartViewController extends Controller
{
    public function show($id)
    {
        // একক প্রোডাক্ট লোড করলাম সাথে তার ক্যাটেগরিও
        $card = Product::with('category')->findOrFail($id);

        // যদি প্রোডাক্টের category_id থাকে, related পণ্য খুঁজব
        $related = collect(); // fallback empty collection

        if ($card->category_id) {
            $related = Product::where('category_id', $card->category_id)
                              ->where('id', '!=', $card->id)
                              ->latest()
                              ->take(6)
                              ->get();
        }

        // right side স্লাইডার পণ্য (Latest বা Gift হিসেবে ধরে)
        $rightSlideItems = Product::latest()->take(10)->get();

        return view('frontend.single-cart-view', compact('card', 'related', 'rightSlideItems'));
    }
}
