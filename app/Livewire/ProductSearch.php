<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductSearch extends Component

{
    public $search = '';
    public $products = [];
    public $hasSearched = false;

    public function searchProducts()
    {
        $this->hasSearched = true;

        $this->products = Product::where('title', 'like', '%' . $this->search . '%')->get();
    }

    public function render()
    {
        return view('livewire.product-search');
    }
}