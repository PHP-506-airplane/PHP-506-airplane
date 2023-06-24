<?php
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : app/Http/Controllers
 * 파일명       : UserController.php
 * 이력         :   v001 0612 박수연 new
**************************************************/

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\AdminInfo;
use App\Models\User;
use App\Models\Userinfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset; // 패스워드 변경 이벤트
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    //로그인
    function login() {
        return view('login');
    }

    function loginpost(Request $req) {
        
        
        $user = Userinfo::where('u_email', $req->u_email)->first();
        
        
        if(!$user || !Hash::check($req->u_pw, $user->u_pw)){
            // Log::debug($req->password . ' : '.$user->password);
            $error = '아이디와 비밀번호를 확인하세요';
            return redirect()->back()->with('alert', $error);
        }

        $validation = $req->validate([
            'u_email'    => 'required|email|max:100'  
            ,'u_pw' => 'required|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,20}$/'
        ]);
        
        Auth::login($user);

        if(Auth::check()) {
            session($user->only('u_email'));
            return redirect()->intended(route('reservation.main'));
        } else {
            $errors = '인증작업 에러';
            return redirect()->back()->with('error', $errors);
        }


        if(Auth::attempt($validation)){
            return redirect()->route('main');

        } else{
            return redirect()->back();
        }
    }

    //회원가입
    function registration() {
        return view('registration');
    }

    function registrationpost(Request $req) {
        // Log::debug('Login Start');
        // return $req;
        // $req->validate([
        //     'u_name'      => 'required|regex:/^[가-힣]+$/|min:2|max:30'  
        //     ,'u_email'    => 'required|email|min:5|max:30'  
        //     ,'u_pw'       => 'required_with:passwordchk|same:passwordchk|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,20}$/'
        //     // 만 14세 이상 가입 가능
        // ]);
        // Log::debug('1 Start');
        $data['u_name'] = $req->name;
        $data['u_email'] = $req->email;
        $data['u_gender'] = $req->gender;
        $data['u_pw'] = Hash::make($req->password);
        $data['u_birth'] = $req->birth;
        $data['qa_no'] = $req->myselect;
        $data['qa_answer'] = $req->answer;

        $user = Userinfo::create($data);
        // Log::debug('1 Start', [$user]);
        if(!$user) {
            $errors = '시스템 에러가 발생하여 회원가입에 실패했습니다.<br>잠시 후에 다시 시도해주세요~.';
            return redirect()
                ->route('users.registration')
                ->with('error', $errors);
        }
        
        //회원가입 완료 로그인 페이지로 이동
        return redirect()
            ->route('users.login')
            ->with('success', '회원가입을 완료했습니다.<br>가입하신 아이디와 비밀번호로 로그인해 주세요.');
    }
    
    //로그아웃
    function logout() {
        
        Session::flush();
        Auth::logout();
        return redirect()->route('reservation.main');
    }

    //회원정보 수정
    function useredit() {
        if(auth()->guest()) {
            return redirect()->route('users.login');
        }

        $user  = Userinfo::find(Auth::user()->u_no);
        
        return view('useredit')->with('data', $user);
    }

    function usereditpost(Request $req) {
        // return $req;
        $arrKey = [];

        $baseuser = Userinfo::find(Auth::user()->u_no);

        if($req->u_name !== $baseuser->u_name)
        {
            $arrKey[] = 'u_name';
        }
        
        $chkList = [
            'u_name'      => 'required|regex:/^[가-힣]+$/|min:2|max:30'
        ];

        $baseuser->u_name = $req->u_name;
        $baseuser->save();

        alert()->success('수정 완료');
        // return view('useredit')->with('data', $baseuser);

        return redirect()->back();
    }

    //탈퇴
    function withdraw() {
        $id = session('u_no');
        // return session()->all();
        // return var_dump(session()->all(), $id);
        $result = Userinfo::destroy(Auth::user()->u_no);
        // return var_dump($result);
        Session::flush();
        Auth::logout();

        // alert()->warning('회원 탈퇴', '탈퇴하시겠습니까?');
        
        return redirect()->route('reservation.main');
    }

    //이메일 인증
    function emailverify($code) {

        $user = Userinfo::where('verification_code', $code)->first();

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
        $user = Userinfo::where('email', $req->email)->first();

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


    // 비밀번호 변경
    function chgpw() {
        return view('chgpw');
    }
    
    function chgpwpost(Request $req)
    {

        $baseuser = Userinfo::find(Auth::user()->u_no);

        if(!Hash::check($req->nowpassword, $baseuser->u_pw)) {
            return redirect()->back()->with('alert', '비밀번호가 일치하지 않습니다.');
        }

        
        $chkList = [
            'password' => 'required_with:passwordchk|same:passwordchk|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,20}$/'
        ];

        $baseuser->u_pw = $req->password;
        $baseuser->save();

       

        return redirect()->route('users.logout')->with('alert','비밀번호가 변경 되었습니다.');
    }

    
}

