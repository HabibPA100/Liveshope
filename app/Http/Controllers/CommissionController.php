<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommissionController extends Controller
{
    public function commission()
    {
        $commission = Subscription::where('user_id', Auth::id())
                        ->where('status', 'approved')
                        ->latest()
                        ->first();

        $plans = SubscriptionPlan::latest()->get();

        return view('frontend.seller.commission', compact('commission', 'plans'));
    }
}
