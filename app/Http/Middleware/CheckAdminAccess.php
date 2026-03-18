<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminAccess
{
    /**
     * Handle an incoming request - Kiểm tra quyền admin chi tiết
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Bạn phải đăng nhập để tiếp tục.');
        }

        $user = Auth::user();

        // Log chi tiết (tuỳ chọn - dùng cho debug)
        // \Log::info('Admin Access Check', [
        //     'user_id' => $user->id,
        //     'user_email' => $user->email,
        //     'role_id' => $user->role_id,
        //     'role_name' => $user->role?->name,
        //     'is_admin' => $user->role_id === 1 || $user->role?->name === 'admin'
        // ]);

        // Kiểm tra quyền admin
        if ($user->role_id !== 1 && (!$user->role || $user->role->name !== 'admin')) {
            return redirect()->route('home')
                ->with('error', 'Bạn không có quyền truy cập khu vực quản trị này.');
        }

        return $next($request);
    }
}
