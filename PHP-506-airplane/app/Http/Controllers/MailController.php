<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MailController extends Controller
{
    public static function mail() {
        return view('mail');
    }

    public static function mailpost(Request $req){
        
        Mail::to($req->email)->send(new SendEmail($req->email));

        return "전송";
    }
}
