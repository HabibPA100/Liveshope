<?php

namespace App\Http\Controllers\Admin;

use App\Models\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AllSellerShowController extends Controller
{
    // Show all sellers
    public function sellerShow()
    {
        $sellers = Seller::latest()->get();
        return view('frontend.admin.all-seller', compact('sellers'));
    }

    // Show edit form
    public function edit($id)
    {
        $seller = Seller::findOrFail($id);
        return view('frontend.admin.edit-seller', compact('seller'));
    }

   // Update seller info
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:sellers,email,' . $id,
            'phone' => 'required|string|max:20',
            'store_name' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'national_id' => 'nullable|string|max:100',
            'status' => 'required|in:Approved,Pending,Rejected',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $seller = Seller::findOrFail($id);

        // Profile Image Upload
        if ($request->hasFile('profile_image')) {
            // Optional: delete old image
            if ($seller->profile_image && Storage::disk('public')->exists($seller->profile_image)) {
                Storage::disk('public')->delete($seller->profile_image);
            }

            $path = $request->file('profile_image')->store('profile_images', 'public');
            $seller->profile_image = $path;
        }

        // Update other fields manually to avoid mass assignment issues
        $seller->name = $request->name;
        $seller->email = $request->email;
        $seller->phone = $request->phone;
        $seller->store_name = $request->store_name;
        $seller->address = $request->address;
        $seller->national_id = $request->national_id;
        $seller->status = $request->status;

        $seller->save();

        return redirect()->route('admin.dashboard')->with('success', 'Seller updated successfully.');
    }

    // Delete seller
    public function destroy($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Seller deleted successfully.');
    }

}
