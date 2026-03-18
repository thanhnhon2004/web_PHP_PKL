<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra user đã đăng nhập chưa
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Bạn cần đăng nhập để vào trang quản trị.');
        }

        $user = Auth::user();

        // Kiểm tra user có role admin không
        // Cách 1: Kiểm tra role_id = 1 (admin)
        if ($user->role_id === 1) {
            return $next($request);
        }

        // Cách 2: Kiểm tra qua relationship role (nếu role_id không phải 1)
        if ($user->role && $user->role->name === 'admin') {
            return $next($request);
        }

        // Nếu không phải admin, redirect về home với thông báo lỗi
        return redirect()->route('home')
            ->with('error', 'Bạn không có quyền truy cập trang quản trị này. Chỉ admin mới có thể truy cập.');
    }
}

