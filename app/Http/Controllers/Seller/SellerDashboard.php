<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellerDashboard extends Controller
{
    public function editProfile(){
        return view('frontend.seller.profile-edit');
    }
}
