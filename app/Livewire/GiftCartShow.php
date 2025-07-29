<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class GiftCartShow extends Component
{
    public function render()
    {
        $gifts = Product::where('is_featured', true)
        ->latest()
        ->take(15) 
        ->get();
        
        return view('livewire.gift-cart-show', compact('gifts'));
    }
}
