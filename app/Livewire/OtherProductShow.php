<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;

class OtherProductShow extends Component
{
    public function render()
    {
        // slug দিয়ে category খোঁজো
        $category = Category::where('slug', 'others')->first();

        // যদি পায় তাহলে category_id দিয়ে পণ্য আনো
        $others = [];

        if ($category) {
            $others = Product::where('category_id', $category->id)
                        ->latest()
                        ->take(12)
                        ->get();
        }

        return view('livewire.other-product-show', compact('others'));
    }
}
