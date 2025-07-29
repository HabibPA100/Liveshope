<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;

class SubscriptionPlanController extends Controller
{
    public function index()
    {
        $plans = SubscriptionPlan::latest()->get();
        return view('frontend.admin.subscription-plane.index', compact('plans'));
    }

    public function create()
    {
        return view('frontend.admin.subscription-plane.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'duration' => 'required|string|max:255',
            'price' => 'required|numeric',
            'tag' => 'nullable|string|max:255',
            'highlight' => 'nullable|boolean',
        ]);

        SubscriptionPlan::create([
            'duration' => $request->duration,
            'price' => $request->price,
            'tag' => $request->tag,
            'highlight' => $request->highlight ?? false,
        ]);

        return redirect()->route('plans.index')->with('success', 'Plan created!');
    }

    public function destroy(SubscriptionPlan $plan)
    {
        $plan->delete();
        return back()->with('success', 'Plan deleted!');
    }
}