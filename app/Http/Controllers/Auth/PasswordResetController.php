<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class PasswordResetController extends Controller
{
    // Show the forgot password form
    public function showLinkRequestForm($type)
    {
        // Validate type
        if (!in_array($type, ['buyer', 'seller', 'admin'])) {
            abort(404);
        }
        return view('frontend.auth.forgot-password', compact('type'));
    }

    // Send reset link email
    public function sendResetLink(Request $request, $type)
    {
        if (!in_array($type, ['buyer', 'seller', 'admin'])) {
            abort(404);
        }

        $request->validate(['email' => 'required|email']);

        // Use the broker according to user type
        $broker = Password::broker($type . 's');  // 'buyer' -> 'buyers', 'seller' -> 'sellers', 'admin' -> 'admins'

        $status = $broker->sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }

    // Show reset password form
    public function showResetForm($type, $token)
    {
        if (!in_array($type, ['buyer', 'seller', 'admin'])) {
            abort(404);
        }
        return view('frontend.auth.reset-password', compact('type', 'token'));
    }

    // Handle reset password post
    public function reset(Request $request, $type)
    {
        if (!in_array($type, ['buyer', 'seller', 'admin'])) {
            abort(404);
        }

        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $broker = Password::broker($type . 's');

        $status = $broker->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = bcrypt($password);
                $user->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', 'Password reset successful!');
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}
