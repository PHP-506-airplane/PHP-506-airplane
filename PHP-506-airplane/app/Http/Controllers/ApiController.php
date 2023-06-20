<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    // 이메일 중복 체크
    public function checkEmail(Request $req)
    {
        Log::debug('Login Start');
        $email = $req->input('u_email');
        Log::debug('Login Start', $req->only('u_email'));
        $user = User::where('u_email', $email)->first();

        if ($user) {
            return response()->json(['message' => '이미 사용 중인 이메일입니다.', 'flg' => 1]);
        }

        return response()->json(['message' => '사용 가능한 이메일입니다.', 'flg' => 1]);
    }
}
