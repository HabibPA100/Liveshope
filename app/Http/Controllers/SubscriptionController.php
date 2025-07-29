<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'subscription_id' => 'required|integer',
            'payment_number' => 'required|string',
            'trx_id' => 'required|string|unique:subscriptions,trx_id',
            'amount' => 'required|integer',
        ],
        [
            'trx_id.unique' => 'এই ট্রানজেকশন আইডি ইতোমধ্যেই ব্যবহৃত হয়েছে বা এটি মেয়াদোত্তীর্ণ।',
        ]
        );

        Subscription::create([
            'user_id' => Auth::id(),
            'subscription_id' => $request->subscription_id,
            'payment_number' => $request->payment_number,
            'trx_id' => $request->trx_id,
            'amount' => $request->amount,
        ]);

        return back()->with('success', 'সাবস্ক্রিপশন অনুরোধ সফলভাবে গ্রহণ করা হয়েছে। আমরা যাচাই করে জানাবো।');
    }

}
