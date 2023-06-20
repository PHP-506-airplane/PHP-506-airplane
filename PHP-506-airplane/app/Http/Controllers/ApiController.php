<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Userinfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    // 이메일 중복 체크
    public function chkEmail(Request $req)
    {
        Log::debug('왔냐?');
        Log::debug($req);
        // $email = $req->email;
        // Log::debug('Login Start', $req->only('u_email'));
        $user = Userinfo::where('u_email', $req->email)->first();
        Log::debug($user);

        if ($user) {
            return response()->json(['message' => '이미 사용 중인 이메일입니다.', 'flg' => 1]);
        }

        return response()->json(['message' => '사용 가능한 이메일입니다.', 'flg' => 0]);
    }
}
