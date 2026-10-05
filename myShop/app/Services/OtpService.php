<?php

namespace App\Services;

use App\Mail\OtpMail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class OtpService
{
    // How long the OTP stays valid (in minutes)
    protected int $expiryMinutes = 5;

    /**
     * Generate a new OTP, store it, and email it to the user.
     */
    public function generateAndSend(string $email): string
    {
        $otp = (string) random_int(100000, 999999);

        Cache::put($this->cacheKey($email), $otp, now()->addMinutes($this->expiryMinutes));

        Mail::to($email)->send(new OtpMail($otp, $this->expiryMinutes));

        return $otp;
    }

    /**
     * Verify a submitted OTP against the stored value.
     */
    public function verify(string $email, string $otp): bool
    {
        $stored = Cache::get($this->cacheKey($email));

        if ($stored && hash_equals($stored, $otp)) {
            Cache::forget($this->cacheKey($email));
            return true;
        }

        return false;
    }

    /**
     * Resend a fresh OTP (invalidates the old one automatically since we overwrite the cache key).
     */
    public function resend(string $email): string
    {
        return $this->generateAndSend($email);
    }

    protected function cacheKey(string $email): string
    {
        return 'otp_' . sha1($email);
    }
}
