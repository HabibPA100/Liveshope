<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Notifications\ContactSummary;

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

         $admins = AdminUser::all();

            foreach ($admins as $admin) {
                try {
                    $admin->notify(new ContactSummary(
                        $validated['name'],
                        $validated['email'],
                        $validated['message']
                    ));
                } catch (\Exception $e) {
                    Log::error("Admin notification/email failed for Admin ID {$admin->id}: " . $e->getMessage());
                }
            }
            
        // ✅ Step 4: Redirect with success message
        return back()->with('success', 'আপনার বার্তা সফলভাবে পাঠানো হয়েছে! আমরা খুব শীঘ্রই আপনার সাথে যোগাযোগ করবো।');
    }
}
