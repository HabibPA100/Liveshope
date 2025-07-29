<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class ShowOrderListController extends Controller
{
    public function index(){
        return view('frontend.seller.show-order-list');
    }
}
