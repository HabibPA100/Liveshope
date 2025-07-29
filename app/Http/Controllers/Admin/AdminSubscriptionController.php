<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AdminSubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::with('seller','plan')->latest()->get();
        
        return view('frontend.admin.subscriptions.index', compact('subscriptions'));
    }

    public function edit($id)
    {
        $subscription = Subscription::findOrFail($id);
        return view('frontend.admin.subscriptions.edit', compact('subscription'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $subscription = Subscription::findOrFail($id);
        $subscription->status = $request->status;
        $subscription->start_date = $request->start_date;
        $subscription->end_date = $request->end_date;
        $subscription->save();

        return redirect()->route('admin.subscriptions')->with('success', 'সাবস্ক্রিপশনের স্ট্যাটাস আপডেট হয়েছে।');
    }

}