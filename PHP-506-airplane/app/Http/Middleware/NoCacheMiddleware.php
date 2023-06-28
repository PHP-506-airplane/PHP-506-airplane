<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NoCacheMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // 웹페이지 캐시 비활성화
        // 로그아웃후 뒤로가기시 로그인된 화면이 보이는 현상 방지
        if (method_exists($response, 'header')) {
            $response->header('Cache-Control', 'private, no-cache, no-store, must-revalidate');
            $response->header('Pragma', 'no-cache');
            $response->header('Expires', 'Thu, 19 Nov 1981 08:52:00 GMT');
        }

        return $response;
    }
}
