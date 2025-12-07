<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = $request->user();

        // Check if email is verified
        if (!$user->hasVerifiedEmail()) {
            // Generate OTP
            $otp = (string) rand(100000, 999999);
            $user->forceFill([
                'otp' => $otp,
                'otp_expires_at' => now()->addMinutes(10),
            ])->save();

            // Send OTP Email
            \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\OtpMail($otp));

            // Logout user
            Auth::guard('web')->logout();

            // Redirect to OTP verify
            return redirect()->route('otp.verify')->with('email', $user->email);
        }

        // === THAY ĐỔI BẮT ĐẦU TỪ ĐÂY ===

        // Kiểm tra vai trò của người dùng vừa đăng nhập
        if ($user->role === 'admin') {
            // Nếu là admin, chuyển hướng đến admin dashboard
            return redirect()->route('admin.dashboard');
        }

        // Nếu không phải admin, chuyển hướng đến dashboard mặc định của người dùng
        return redirect()->intended('/home');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
