<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Collection;

class PanjabiShow extends Component
{
    public function render()
    {
        $panjabis = Product::where('category_id', 37)
            ->latest()
            ->take(5)
            ->get();

        return view('livewire.panjabi-show', compact('panjabis'));
    }
}
