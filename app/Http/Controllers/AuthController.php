<?php

namespace App\Http\Controllers;

use App\Mail\AccountActivationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function activateAccount($token)
    {
 
        $user = User::where('activation_token', $token)->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid activation token.'], 404);
        }

        $user->is_activated = true;
        $user->activation_token = null; 
        $user->save();

        return response()->json(['message' => 'Account activated successfully.'], 200);
    }

    public function validateToken(Request $request)
    {
    $user = User::where('activation_token', $request->token)->first();

    if (!$user || Carbon::parse($user->token_expires_at)->isPast()) {
        return response()->json(['message' => 'Your activation link has expired. Please request a new one.'], 400);
    }

    return response()->json(['message' => 'Token is valid. Proceed to set the password.'], 200);
    }

public function resendActivationLink(Request $request)
{
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return response()->json(['message' => 'No user found with that email address.'], 400);
    }

    $user->generateActivationToken();
    Mail::to($user->email)->send(new AccountActivationMail($user));

    return response()->json(['message' => 'A new activation link has been sent to your email.']);
}



public function setPassword(Request $request)
{
    $request->validate([
        'password' => 'required|string|min:8',
        'token' => 'required|string',
    ]);

    $user = User::where('activation_token', $request->token)->first();

    if (!$user || Carbon::parse($user->token_expires_at)->isPast()) {
        return response()->json(['message' => 'Your activation link has expired. Please request a new one.'], 400);
    }

    // Set password and clear token
    $user->password = bcrypt($request->password);
    $user->activation_token = null;
    $user->token_expires_at = null; // Optionally, clear expiration after setting password
    $user->status = 'Active'; // Activate the user
    $user->save();

    return response()->json(['message' => 'Password set successfully. You can now log in.'], 200);
}

}
