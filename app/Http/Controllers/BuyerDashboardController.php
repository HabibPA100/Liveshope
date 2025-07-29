<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BuyerDashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::guard('buyer')->user();
        return view('frontend.buyer.buyer-dashboard', compact('user'));
    }
}
