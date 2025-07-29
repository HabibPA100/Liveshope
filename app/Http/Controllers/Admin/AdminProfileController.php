<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\AdminUser;  

class AdminProfileController extends Controller
{
    public function profile()
    {
        $admin = auth('admin')->user();

        return view('frontend.admin.profile.edit', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = auth('admin')->user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:admin_user,email,' . $admin->id,
            'nid'   => 'nullable|string|max:50',
            'dob'   => 'nullable|date',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('profile_image')) {
            if ($admin->profile_image && Storage::disk('public')->exists($admin->profile_image)) {
                Storage::disk('public')->delete($admin->profile_image);
            }

            $path = $request->file('profile_image')->store('admin_profiles', 'public');
            $admin->profile_image = $path;
        }

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->nid = $request->nid;
        $admin->dob = $request->dob;

        $admin->save();

        return redirect()->route('admin.dashboard')->with('success', 'Profile updated successfully!');
    }
}
