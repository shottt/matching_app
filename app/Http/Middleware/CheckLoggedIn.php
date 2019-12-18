<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // ログインしているかどうかチェックする
        if(!Auth::check()){
            return redirect('login');
            // return response()->json(['result_flag' => false]);
        }
        // リクエストヘッダーに保存したIDとログインユーザーIDと一致しているか確認
        if($request->header('aut_id') != Auth::id()){
            return redirect('login');
        }
        return $next($request);
    }
}
