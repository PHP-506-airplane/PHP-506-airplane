<?php
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : Http/Middleware
 * 파일명       : AdminMiddleware.php
 * 이력         :   v001 0623 이동호 new
**************************************************/

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        if (empty(Auth::user()) || Auth::user()->admin_flg === '0') {
            return redirect()->route('notice.index')->with('alert', '권한이 없습니다.');
        }

        return $next($req);
    }
}
