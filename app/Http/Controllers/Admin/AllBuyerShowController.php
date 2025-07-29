<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use Illuminate\Http\Request;

class AllBuyerShowController extends Controller
{
    public function buyerShow(){
        $buyers = Buyer::latest()->get();
        return view('frontend.admin.all-buyer', compact('buyers'));
    }
}
