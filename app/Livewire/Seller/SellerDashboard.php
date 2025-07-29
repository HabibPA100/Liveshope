<?php

namespace App\Livewire\Seller;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class SellerDashboard extends Component
{

    public function logout()
    {
        Auth::guard('seller')->logout();
        return redirect()->route('login');
    }
    
    public function render()
    {
        return view('livewire.seller.seller-dashboard');
    }
}
