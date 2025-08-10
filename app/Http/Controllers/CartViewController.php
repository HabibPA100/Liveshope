<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CartViewController extends Controller
{
    public function show($id)
    {
        // যদি এটা Facebook bot হয়
        if (Str::contains(request()->header('User-Agent'), 'facebookexternalhit')) {
            $card = Product::with('category')->find($id);

            if (!$card) {
                // Facebook bot এর জন্য fallback dummy product
                $card = (object)[
                    'title' => 'Product not found',
                    'description' => 'This product is not available anymore.',
                    'image' => 'https://www.liveshope.xyz/default-image.jpg',
                    'category_id' => null
                ];
                $related = collect();
                $rightSlideItems = collect();
                return response()->view('frontend.single-cart-view', compact('card', 'related', 'rightSlideItems'), 200);
            }
        }

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
