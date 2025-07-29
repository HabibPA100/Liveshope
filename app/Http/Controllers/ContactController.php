<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        return view('frontend.contact');
    }

    public function send(Request $request)
    {
        // ✅ Step 1: Validate form input
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'message' => 'required|string|min:10',
        ]);

        Contact::create($validated);

        // ✅ Step 4: Redirect with success message
        return back()->with('success', 'আপনার বার্তা সফলভাবে পাঠানো হয়েছে! আমরা খুব শীঘ্রই আপনার সাথে যোগাযোগ করবো।');
    }
}
