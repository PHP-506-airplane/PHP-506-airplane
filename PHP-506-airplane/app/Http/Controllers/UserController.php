<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    function login() {
        return view('login');
    }

    function loginpost(Request $req) {
        $req->validate([
            'email'    => 'required|email|max:100'  
            ,'password' => 'required|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,20}$/'
        ]);

        $user = User::where('email', $req->email)->first();
        if(!$user || !(Hash::check($req->password, $user->password))){
            Log::debug($req->password . ' : '.$user->password);
            $errors = '아이디와 비밀번호를 확인하세요';
            return redirect()->back()->with('error', $errors);
        }

        Auth::login($user);
        if(Auth::check()) {
            //로그인 성공
            session($user->only('id'));
            return redirect()->intended(route('boards.index'));
        } else {
            $errors = '인증작업 에러';
            return redirect()->back()->with('error', $errors);
        }
    }

    function registration() {
        return view('registration');
    }

    function registrationpost(Request $req) {
        $req->validate([
            'name'      => 'required|regex:/^[가-힣]+$/|min:2|max:30'
            ,'email'    => 'required|email|max:100'  
            ,'password' => 'required_with:passwordchk|same:passwordchk|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,20}$/'
        ]);

        $data['name'] = $req->name;
        $data['email'] = $req->email;
        $data['password'] = Hash::make($req->password);

        $user = User::create($data);
        if(!$user) {
            $errors = '시스템 에러가 발생하여, 회원가입에 실패했습니다.<br>잠시 후에 다시 시도해주세요~.';
            return redirect()
                ->route('users.registration')
                ->with('error', $errors);
        }
        
        //회원가입 완료 로그인 페이지로 이동
        return redirect()
            ->route('users.login')
            ->with('success', '회원가입을 완료했습니다.<br>가입하신 아이디와 비밀번호로 로그인해 주세요.');
    }

    function useredit() {
        $user  = User::find(Auth::User()->id);
        
        return view('useredit')->with('data', $user);
    }

    function usereditpost(Request $req) {
        $arrKey = [];

        $baseUser  = User::find(Auth::User()->id);
            
        //기존 비번 틀렸을 때 에러처리
        if(!Hash::check($req->password, $baseUser->password)) {
            return redirect()->back()->with('error', '기존 비밀번호를 확인해 주세요');
        }

        if($req->name !== $baseUser->name) {
            $arrKey[] = 'name';
        }
        if(!isset($req->password)) {
            $arrKey[] = 'password';
        }   
        //유효성체크를 하는 모든 항목 리스트:
        $chkList = [
            'name'      => 'required|regex:/^[가-힣]+$/|min:2|max:30'
            ,'bpassword' => 'regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,20}$/'
            ,'password' => 'same:passwordchk|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,20}$/'
        ];
    }

    function withdraw() {
        $id = session('id');

        $result = User::destroy('id');
        Session::flush();
        Auth::logout();
    }
    
    function logout() {
        
        Session::flush();
        Auth::logout();
        return redirect()->route('users.login');
    }
}
