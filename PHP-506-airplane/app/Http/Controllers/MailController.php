<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MailController extends Controller
{
    public static function sendSignupEmail() {
        return view('email');
    }
    public static function sendSignupEmailpost(Request $req){
        
        Mail::to($req->email)->send(new SendEmail($req->data));

        return "갔나?";
    }

    public function emailanswer(Request $req) {

        $baseUser  = User::find(Auth::User()->id);
        
        if($req->answer !== $baseUser->answer) {
            return "이메일 인증 답변이 일치하지 않ㅅㅂ니다^^";
        }
    }
}
