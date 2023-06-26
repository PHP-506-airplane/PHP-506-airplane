<?php
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : Http/Middleware
 * 파일명       : AdminButtonMiddleware.php
 * 이력         :   v001 0623 이동호 new
**************************************************/

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminButtonMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $req, Closure $next)
    {
        if (!empty(Auth::user()) && Auth::user()->admin_flg === '1') {
            // view()->share() : 모든 뷰에 공유할 데이터를 설정하는 데 사용
            view()->share('isAdmin', true);
        } else {
            view()->share('isAdmin', false);
        }
    
        return $next($req);
    }
}
