<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

class AddToCart extends Component
{
    public int $productId;
    public string $buttonClass;
    public bool $isDisabled = false;

    public function mount(int $productId, string $buttonClass = ''): void
    {
        $this->productId = $productId;
        $this->buttonClass = $buttonClass;

        $this->updateDisableStatus();
    }

    public function add(): void
    {
        if ($this->isDisabled) {
            // ইউজার যদি জোর করে আবার ক্লিক করে
            $this->dispatch('swal:error', data: [
                'title' => 'দুঃখিত !',
                'text' => 'পণ্যটি আগেই যুক্ত করা হয়েছে ধন্যবাদ!'
            ]);
            return;
        }

        $product = Product::findOrFail($this->productId);

        $cart = Session::get('cart', []);

        $cart[$product->id] = [
            'id' => $product->id,
            'name' => $product->title,
            'price' => $product->offer_price,
            'product_image' => $product->product_image,
            'quantity' => 1,
            'seller_id' => $product->seller_id,
        ];

        Session::put('cart', $cart);

        $this->isDisabled = true; // ভিজুয়ালি disable

        $this->dispatch('cartUpdated');

        $this->dispatch('swal:success', data: [
                'title' => $product->title,
                'text' => 'পণ্যটি কার্ডে যুক্ত হয়েছে ধন্যবাদ!'
            ]);
    }

    private function updateDisableStatus(): void
    {
        $cart = Session::get('cart', []);
        $this->isDisabled = isset($cart[$this->productId]);
    }

    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
