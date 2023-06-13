<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset; // 패스워드 변경 이벤트
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

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

    //이메일 인증
    function emailverify($code) {

        $user = User::where('verification_code', $code)->first();

        if (!$user) {
            $error = '유효하지 않은 이메일 주소입니다.';
            return redirect()->route('users.login')->with('error', $error);
        }

        $currentTime = now();
        $validityPeriod = $user->validity_period;

        if ($currentTime > $validityPeriod) {
            $error = '인증 유효시간이 만료되었습니다.';
            $resendEmailUrl = route('resend.email', ['email' => $user->email]);
            return redirect()->back()->with('error', $error)->with('resend_email', true)->with('resend_email_url', $resendEmailUrl);
        }

        $user->verification_code = null;
        $user->validity_period = null;
        $user->email_verified_at = now();
        $user->save();

        $success = '이메일 인증이 완료되었습니다.<br>가입하신 아이디와 비밀번호로 로그인 해 주십시오.';
        return redirect()->route('users.login')->with('success', $success);
    }

    function emailverify_resend(Request $req) {
        $user = User::where('email', $req->email)->first();

        if (!$user) {
            $error = '해당 이메일로 가입된 계정이 없습니다.';
            return redirect()->back()->with('error', $error);
        }

        if ($user->email_verified_at) {
            $error = '해당 계정은 이미 이메일 인증이 완료되었습니다.';
            return redirect()->back()->with('error', $error);
        }

        $verification_code = Str::random(30);
        $validity_period = now()->addMinutes(1);

        $user->verification_code = $verification_code;
        $user->validity_period = $validity_period;
        $user->save();

        Mail::to($user->email)->send(new SendEmail($user));

        $success = '이메일 인증 메일을 재전송하였습니다.<br>이메일을 확인하여 계정을 활성화해 주세요.';
        return redirect()->back()->with('success', $success);
    }

    // 이메일 찾기
    function findemail(Request $req) {

    }
    // 비밀번호 찾기
    function findpassword(Request $req) {
        
    }

    //비밀번호 변경
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status != Password::PASSWORD_RESET) {
            throw ValidationException::withMessages([
                'email' => [__($status)],
            ]);
        }

        return response()->json(['status' => __($status)]);
    }

    // 비밀번호 찾기(수신된 이메일에서 버튼 클릭시 새비번 입력할 수 있느느 페이지로 이동(이거 아님))
    public function forgotPassword(Request $req)
    {
        $req->validate([
            'email' => 'required|email'
        ], $req->all());

        $status = Password::sendResetLink(
            $req->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            throw ValidationException::withMessages([
                'email' => [__($status)],
            ]);
        }

        return response()->json(['status' => __($status)]);
    }
} 

