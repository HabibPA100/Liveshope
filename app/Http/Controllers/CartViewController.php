<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CartViewController extends Controller
{
    public function show($id)
    {

        // নরমাল ইউজারের জন্য default লজিক
        $card = Product::with('category')->findOrFail($id);

        $related = collect();
        if ($card->category_id) {
            $related = Product::where('category_id', $card->category_id)
                            ->where('id', '!=', $card->id)
                            ->latest()
                            ->take(6)
                            ->get();
        }

        $rightSlideItems = Product::latest()->take(10)->get();

        return view('frontend.single-cart-view', compact('card', 'related', 'rightSlideItems'));
    }
}
