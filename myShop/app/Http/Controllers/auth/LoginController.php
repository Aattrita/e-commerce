<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Services\OtpService;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Invalid email']);
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Invalid password']);
        }


        // credentials correct → generate & send OTP here
        // e.g. generate OTP, save to $user, send via mail/sms, then:
        session()->put('user_information', [
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);

        app(OtpService::class)->generateAndSend($user->email);
        return redirect()->route('otp.verify');
    }
}
