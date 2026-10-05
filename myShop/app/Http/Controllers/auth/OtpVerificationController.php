<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpVerificationController extends Controller
{
    protected OtpService $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    /**
     * Show the OTP verification page.
     */
    public function show()
    {
        // Expect the email to have been stashed in session during the login step
        if (!session('user_information.email')) {
            return redirect()->route('staff.login');
        }

        return view('auth.otpverification', [
            'email' => session('user_information.email'),
        ]);
    }

    /**
     * Verify the submitted OTP.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'digits:6'],
        ]);

        $email = session('user_information.email');

        if (!$email) {
            return redirect()->route('staff.login')->withErrors(['otp' => 'Session expired. Please log in again.']);
        }

        if ($this->otpService->verify($email, $request->otp)) {


            // Log the user in fully now that OTP is confirmed
            Auth::loginUsingId(session('user_information.user_id'));
            session()->forget('user_information.user_id');

            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors(['otp' => 'The code you entered is invalid or has expired.']);
    }

    /**
     * Resend a fresh OTP to the same email.
     */
    public function resend()
    {
        $email = session('user_information.email');

        if (!$email) {
            return redirect()->route('staff.login');
        }

        $this->otpService->resend($email);

        return back()->with('status', 'A new code has been sent to your email.');
    }
}
