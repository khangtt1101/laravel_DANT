<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra xem người dùng đã đăng nhập và có vai trò là 'admin' hay không
        if (Auth::check() && Auth::user()->role === 'admin') {
            // Nếu đúng, cho phép request được tiếp tục
            return $next($request);
        }

        // Nếu không phải admin, chuyển hướng về trang dashboard thông thường
        // Hoặc bạn có thể trả về lỗi 403 (Forbidden) bằng cách dùng: abort(403, 'Unauthorized Action.');
        return redirect('/dashboard')->with('error', 'Bạn không có quyền truy cập vào khu vực này.');
    }
}