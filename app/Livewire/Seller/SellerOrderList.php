<?php

namespace App\Livewire\Seller;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class SellerOrderList extends Component
{
    public $orders = [];

    public function mount()
    {
        $sellerId = Auth::guard('seller')->id();

        $this->orders = Order::latest()->get()->filter(function ($order) use ($sellerId) {
            return collect($order->cart_items)->contains('seller_id', $sellerId);
        });
    }

    public function render()
    {
        return view('livewire.seller.seller-order-list', [
            'orders' => $this->orders,
            'sellerId' => Auth::guard('seller')->id(),
        ]);
    }
}
