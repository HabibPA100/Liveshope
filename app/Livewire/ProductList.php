<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProductList extends Component
{
    public function render()
    {
        return view('livewire.product-list', [
            'products' => Product::where('seller_id', Auth::id())->latest()->get(),
        ]);
    }

    public function edit($productId)
    {
        $this->dispatch('editProduct', $productId); // Emit event globally
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();
        session()->flash('message', 'Product deleted successfully!');
    }
}
