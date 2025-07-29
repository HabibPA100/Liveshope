<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class AllProductShow extends Component
{
     public function render()
    {
        $products = Product::latest()->paginate(12); // সর্বশেষ 6টি প্রোডাক্ট

        return view('livewire.all-product-show', compact('products'));
    }
}
