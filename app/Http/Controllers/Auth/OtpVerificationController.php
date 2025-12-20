<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class OtpVerificationController extends Controller
{
    /**
     * Display the OTP verification view.
     */
    public function create(Request $request): View|RedirectResponse
    {
        // If email is not in session/request or user already verified, redirect appropriately
        // For simplicity, we assume the flow comes from register
        if (
            !$request->session()->has('email')
            && !$request->has('email')
            && !$request->session()->has('registration_data')
            && !$request->old('email')
        ) {
            return redirect()->route('login');
        }

        return view('auth.verify-otp');
    }

    /**
     * Handle an incoming OTP verification request.
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $request->validate([
            'otp' => ['required', 'string'],
            'email' => ['required', 'email'],
        ]);

        if ($request->session()->has('registration_data')) {
            $data = $request->session()->get('registration_data');

            // Validate OTP from session
            if ($data['otp'] !== $request->otp) {
                throw ValidationException::withMessages([
                    'otp' => __('Mã OTP không chính xác.'),
                ]);
            }

            if (Carbon::parse($data['otp_expires_at'])->isPast()) {
                throw ValidationException::withMessages([
                    'otp' => __('Mã OTP đã hết hạn.'),
                ]);
            }

            // Create User
            $user = User::create([
                'full_name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'], // Already hashed
                'email_verified_at' => now(), // Auto verify
            ]);

            event(new \Illuminate\Auth\Events\Registered($user));

            // Cleanup session
            $request->session()->forget(['registration_data', 'email']);

            Auth::login($user);

            if ($request->wantsJson()) {
                return response()->json(['redirect' => route('dashboard', absolute: false)]);
            }

            return redirect()->intended(route('dashboard', absolute: false));
        }

        // Fallback: Existing User (Login Flow)
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => __('Email không tồn tại.'),
            ]);
        }

        if ($user->otp !== $request->otp) {
            throw ValidationException::withMessages([
                'otp' => __('Mã OTP không chính xác.'),
            ]);
        }

        if ($user->otp_expires_at && Carbon::parse($user->otp_expires_at)->isPast()) {
            throw ValidationException::withMessages([
                'otp' => __('Mã OTP đã hết hạn.'),
            ]);
        }

        // Clear OTP
        $user->forceFill([
            'otp' => null,
            'otp_expires_at' => null,
            'email_verified_at' => now(), // Mark as verified if using must verify email
        ])->save();

        Auth::login($user);

        if ($request->wantsJson()) {
            return response()->json(['redirect' => route('dashboard', absolute: false)]);
        }

        return redirect()->intended(route('dashboard', absolute: false));
    }
}
