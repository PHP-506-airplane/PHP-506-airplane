<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function check($email){
        $user = User::where('email', $email)->first();
        return response()->json([
            'user' => $user
        ]);
    }
}
