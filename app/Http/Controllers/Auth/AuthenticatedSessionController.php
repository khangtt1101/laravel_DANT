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

        // === THAY ĐỔI BẮT ĐẦU TỪ ĐÂY ===

        // Kiểm tra vai trò của người dùng vừa đăng nhập
        if ($request->user()->role === 'admin') {
            // Nếu là admin, chuyển hướng đến admin dashboard
            return redirect()->route('admin.dashboard');
        }

        // Nếu không phải admin, chuyển hướng đến dashboard mặc định của người dùng
        return redirect()->intended('/dashboard');
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
