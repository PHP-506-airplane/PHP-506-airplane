<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;

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
        
    }
}
