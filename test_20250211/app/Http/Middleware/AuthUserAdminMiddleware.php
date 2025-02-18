<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Shop\Entity\User;

class AuthUserAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 判斷是否有登入
        if (!session()->has('user_id')) {
            return redirect('/user/auth/signin');
        } else {
            // 如果有登入 則判斷是否為管理者
            $user_id = session()->get('user_id');
            $user = User::where('id', $user_id)->first();
            if ($user->type !== 'A') {
                // 如果非管理者 則回到註冊頁面
                return redirect('/user/auth/signup');
            } else {
                // 如果是管理者 則正常運作
                return $next($request);
            }
        }
    }
}
