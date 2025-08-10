<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProductList extends Component
{
    public function render()
    {
        if (Auth::guard('admin')->check()) {
            // যদি অ্যাডমিন হয়, সব প্রোডাক্ট দেখাবে
            $products = Product::latest()->get();
        } else {
            // seller বা অন্য কেউ হলে নিজের প্রোডাক্ট দেখাবে
            $products = Product::where('seller_id', Auth::id())->latest()->get();
        }

        return view('livewire.product-list', [
            'products' => $products,
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
