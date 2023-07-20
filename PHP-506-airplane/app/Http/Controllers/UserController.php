<?php

/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : app/Http/Controllers
 * 파일명       : UserController.php
 * 이력         :   v001 0612 박수연 new
 *                  v002 0626 이동호 add 이전페이지 기억
 *                  v003 0718 이동호 add 이메일 인증, 찾기, 트랜잭션
 **************************************************/

namespace App\Http\Controllers;

use App\Mail\FindPassword;
use App\Mail\SendEmail;
use App\Models\EmailVerify;
use App\Models\Userinfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Rules\MinAge;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    //로그인
    function login()
    {
        return view('login');
    }

    function loginpost(Request $req)
    {
        $req->validate([
            'u_email'   => 'required|email|max:100'
            ,'u_pw'     => 'required|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,20}$/'
        ]);

        $user = Userinfo::where('u_email', $req->u_email)->first();

        $emailVertify = EmailVerify::where('u_no', $user->u_no)->first();

        if (!$user || !Hash::check($req->u_pw, $user->u_pw)) {
            // Log::debug($req->password . ' : '.$user->password);
            $error = '아이디와 비밀번호를 확인하세요';
            return redirect()->back()->with('alert', $error);
        }

        if (!$emailVertify->email_verified_at) {
            $resendEmailUrl = route('user.resendemail', ['u_email' => $user->u_email]);
            return redirect()->back()->with('emailMsg', '메일인증이 완료되지 않은 계정입니다.')->with('resend_email_url', $resendEmailUrl);
        }

        Auth::login($user);

        if (Auth::check()) {
            if ($user->temp_pw === '1') {
                Session::put('alert', '임시 비밀번호로 로그인 하셨습니다.\n비밀번호를 변경해주세요.');
            }
            session($user->only('u_email'));

            // v002 add 이동호
            if (Session::has('previous_url')) {
                $previousUrl = Session::get('previous_url');
                Session::forget('previous_url'); // 세션에서 URL 제거
                return redirect()->intended($previousUrl); // 이전 페이지로 리다이렉트
            }

            // cookie ver. --------------------------------------------------
            // if (Cookie::has('prev_url')) {
            //     Log::debug('유저if들어옴');
            //     $prevUrl = Cookie::get('prev_url');
            //     Cookie::forget('prev_url'); // 세션에서 URL 제거
            //     return redirect()->intended($prevUrl); // 이전 페이지로 리다이렉트
            // }
            // /cookie ver. --------------------------------------------------

            return redirect()->intended(route('reservation.main'));
        } else {
            $errors = '인증작업 에러';
            return redirect()->back()->with('error', $errors);
        }
    }

    //회원가입
    function registration()
    {
        return view('registration');
    }

    function registrationpost(Request $req)
    {
        $req->validate([
            'name'          => 'required|regex:/^[가-힣]+$/u|min:2|max:30'
            ,'email'        => 'required|email|min:5|max:30|regex:/^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i'
            ,'password'     => 'required_with:passwordchk|same:passwordchk|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,20}$/u'
            ,'passwordchk'  => 'required_with:password|same:password|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,20}$/u'
            ,'birth'        => ['required', 'date', new MinAge(14)]
            ,'qa_no'        => 'required|regex:/[1-4]*$/'
            ,'qa_answer'    => 'required|max:30'
        ]);

        try {
            DB::beginTransaction();
            $data['u_name'] = $req->name;
            $data['u_email'] = $req->email;
            $data['u_gender'] = $req->gender;
            $data['u_pw'] = Hash::make($req->password);
            $data['u_birth'] = $req->birth;
            $data['qa_no'] = $req->qa_no;
            $data['qa_answer'] = $req->qa_answer;

            //insert하고 insert된 결과가 user에 담김
            $user = Userinfo::create($data);
            // if(!$user) {
            //     $errors = '시스템 에러가 발생하여 회원가입에 실패했습니다.<br>잠시 후에 다시 시도해주세요~.';
            //     return redirect()
            //         ->route('users.registration')
            //         ->with('error', $errors);
            // }

            $verification_code = Str::random(30); // 인증 코드 생성
            $validity_period = now()->addMinute(5); // 유효기간 설정

            $userEmail['u_no'] = $user->u_no;
            $userEmail['verification_code'] = $verification_code;
            $userEmail['validity_period'] = $validity_period;
            $emailVerify = EmailVerify::create($userEmail);

            // if(!$emailVerify) {
            //     $errors = '시스템 에러가 발생하여 회원가입에 실패했습니다.<br>잠시 후에 다시 시도해주세요~.';
            //     return redirect()
            //         ->route('users.registration')
            //         ->with('error', $errors);
            // }

            Mail::to($user->u_email)->send(new SendEmail($user, $emailVerify));

            DB::commit();

            //회원가입 완료 로그인 페이지로 이동
            return redirect()
                ->route('users.login')
                ->with('alert', '가입하신 이메일로 인증메일이 발송되었습니다.\n인증을 완료해주세요.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);
            return redirect()->back()->with('alert', '시스템 에러가 발생하여 회원가입에 실패했습니다.\n잠시 후에 다시 시도해주세요~.');
        }
    }

    //로그아웃
    function logout()
    {
        Session::flush();   //세션 파기
        Auth::logout();
        return redirect()->route('reservation.main');
        // return redirect()->back();
    }

    //비밀번호 로그아웃
    function logoutPw()
    {
        Session::flush();   //세션 파기
        Auth::logout();
        return redirect()->route('reservation.main')->with('alert', '비밀번호가 변경되었습니다.');
        // return redirect()->back();
    }

    //회원정보 수정
    function useredit()
    {
        if (auth()->guest()) {
            return redirect()->route('users.login');
        }

        //지금 로그인 돼있는 엘로퀀트의 u_no만 뽑음
        $user  = Userinfo::find(Auth::user()->u_no);

        return view('useredit')->with('data', $user);
    }

    function usereditpost(Request $req)
    {
        //수정한 항목을 담는 배열(루프를 최소한으로 돌리기 위해서)
        $arrKey = [];

        //기존 데이터 가져옴
        $baseuser = Userinfo::find(Auth::user()->u_no);

        //db에 담긴 이름이랑 넣은 이름이랑 같은지 확인하고 다를 경우에만 배열에 담음
        if ($req->u_name !== $baseuser->u_name) {
            $arrKey[] = 'u_name';
        }

        $req->validate([
            'u_name'      => 'required|regex:/^[가-힣]+$/|min:2|max:30'
        ]);

        if (!$baseuser) {
            $errors = '시스템 에러가 발생하여 수정에 실패했습니다.\n잠시 후에 다시 시도해주세요~.';
            return redirect()
                ->route('users.useredit')
                ->with('error', $errors);
        }

        $baseuser->u_name = $req->u_name;
        $baseuser->save();

        return redirect()->back()->with('alert', '수정되었습니다.');
    }

    //탈퇴
    function withdraw()
    {
        $id = session('u_no');
        $result = Userinfo::destroy(Auth::user()->u_no);
        Session::flush();
        Auth::logout();

        return redirect()->route('reservation.main')->with('alert', '탈퇴되었습니다.');
    }

    // ---------------------------------
    // 메소드명	: verify
    // 기능		: 인증코드를 받아 유저인증
    // 파라미터	: String      $code
    // 리턴값	:             redirect         
    // ---------------------------------
    function verify($code)
    {
        try {
            DB::beginTransaction();
            $user = EmailVerify::where('verification_code', $code)
                ->join('user_info AS user', 'regist_verify.u_no', 'user.u_no')
                ->first();

            Log::debug($user);

            if (!$user) {
                $error = '인증이 완료되었거나 유효하지 않은 이메일 주소입니다.';
                return redirect()->route('users.login')->with('emailMsg', $error);
            }

            $currentTime = now();
            $validityPeriod = $user->validity_period;

            if ($currentTime > $validityPeriod) {
                $error = '인증 유효시간이 만료되었습니다.';
                $resendEmailUrl = route('user.resendemail', ['u_email' => $user->u_email]);
                return redirect()->route('users.login')->with('emailMsg', $error)->with('resend_email_url', $resendEmailUrl);
            }

            $user->verification_code = null;
            $user->validity_period = null;
            $user->email_verified_at = now();
            $user->save();
            DB::commit();

            return redirect()->route('users.login')->with('alert', '이메일 인증이 완료되었습니다.\n가입하신 이메일과 비밀번호로 로그인 해 주세요.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);
            return redirect()->route('users.login')->with('alert', '인증중 오류가 발생했습니다.');
        }
    }

    // ---------------------------------
    // 메소드명	: resendemail
    // 기능		: 인증메일을 재전송
    // 파라미터	: Request      $req
    // 리턴값	:              redirect         
    // ---------------------------------
    function resendemail(Request $req)
    {
        try {
            DB::beginTransaction();
            // Log::debug('재전송 req : ', [$req->u_email]);
            $user = Userinfo::where('u_email', $req->u_email)
                ->join('regist_verify AS reg', 'reg.u_no', 'user_info.u_no')
                ->first();

            $mail = EmailVerify::where('u_no', $user->u_no)
                ->first();
            Log::debug('유저 : ', [$user]);

            if (!$user) {
                $error = '해당 이메일로 가입된 계정이 없습니다.';
                return redirect()->route('users.login')->with('emailMsg', $error);
            }

            if ($mail->email_verified_at) {
                $error = '해당 계정은 이미 이메일 인증이 완료되었습니다.';
                return redirect()->route('users.login')->with('emailMsg', $error);
            }

            if ($user->send_at >= now()->subMinutes(5)) {
                $error = '메일발송은 최소 5분간격으로 가능합니다.';
                $resendEmailUrl = route('user.resendemail', ['u_email' => $user->u_email]);
                return redirect()->back()->with('emailMsg', $error)->with('resend_email_url', $resendEmailUrl);
            }

            $verification_code = Str::random(30);
            $validity_period = now()->addMinute(5);

            $mail->verification_code = $verification_code;
            $mail->validity_period = $validity_period;
            $mail->send_at = now();
            $mail->save();

            Mail::to($user->u_email)->send(new SendEmail($user, $mail));
            DB::commit();

            $success = '인증 메일을 재전송하였습니다.\n메일함을 확인하여 계정을 활성화해 주세요.';
            return redirect()->back()->with('alert', $success);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);
            return redirect()->route('users.login')->with('alert', '인증중 오류가 발생했습니다.');
        }
    }


    // 비밀번호 변경
    function chgpw()
    {
        return view('chgpw');
    }

    function chgpwpost(Request $req)
    {

        $baseuser = Userinfo::find(Auth::user()->u_no);

        if (!Hash::check($req->nowpassword, $baseuser->u_pw)) {
            return redirect()->back()->with('alert', '비밀번호가 일치하지 않습니다.');
        }


        $chkList = [
            'password' => 'required_with:passwordchk|same:passwordchk|regex:/^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,20}$/'
        ];

        $baseuser->u_pw = Hash::make($req->password);

        // 임시 비밀번호일경우 플래그 변경
        if ($baseuser->temp_pw === '1') {
            $baseuser->temp_pw = '0';
        }
        $baseuser->save();

        return redirect()->route('users.logoutPw');
    }

    public function getCurrentUser()
    {
        $user = Userinfo::find(auth()->user()->u_no);
        $userData['name'] = $user->u_name;
        $userData['tel'] = $user->u_tel;

        return response()->json($userData);
    }
    public function find(Request $req) {
            return view('find')->with('type', $req->type);
        }

        public function redirect($provider){
            return Socialite::driver($provider)->redirect();
        }
    
        protected function Callback($provider)
        {
            $socialUser = Socialite::driver($provider)->user();
    
            $user = Userinfo::where('u_email', $socialUser->getEmail())->first();
    
            // db와 email이 일치하지 않을경우 새로운 사용자 만들고 로그인 처리
            if (!$user) {
                $new_user = UserInfo::create([
                    'u_email' => $socialUser->getEmail(),
                    'u_name'  => '오재훈',
                ]);
                Auth::login($new_user);
            }else{
                // db와 email이 일치할 경우 로그인 처리
                Auth::login($user);
            }
    
            return redirect()->intended('/');
        }
    
    // ---------------------------------
    // 메소드명	: findEmail
    // 기능		: 일치하는 정보의 이메일을 찾음
    // 파라미터	: Request      $req
    // 리턴값	: json         
    // ---------------------------------
    public function findEmail(Request $req) {
        try {
            DB::beginTransaction();

            $email = Userinfo::where('u_name', $req->name)
                ->where('u_birth', $req->birth)
                ->where('qa_no', $req->qa_no)
                ->where('qa_answer', $req->qa_anw)
                // 관리자 계정이면 검색안되게
                ->where('admin_flg', '!=', '1')
                ->select('u_email')
                ->first();

            if (!$email) {
                return response()
                ->json([
                    'success'   => false
                    ,'msg'      => '일치하는 정보가 없습니다.'
                    ,'color'    => 'red'
                ]);
            }

            // 이메일 주소에서 @를 기준으로 배열로 분리
            $emailParts = explode('@', $email->u_email);
            // 이메일의 앞부분
            $firstPart = mb_substr($emailParts[0], 0, 3);
            // 이메일의 도메인
            $secondPart = $emailParts[1];
            // 앞부분의 길이
            $firstPartLength = strlen($emailParts[0]) - strlen($firstPart);
            // 잘라낸만큼 *으로 채우기
            $hiddenPart = str_repeat('*', $firstPartLength);

            $emailAdderss = $firstPart . $hiddenPart . '@' . $secondPart;

            return response()
                ->json([
                    'success'   => true
                    ,'msg'      => $req->name . '님의 이메일은 ' . $emailAdderss . '입니다.'
                    ,'color'    => 'black'
                ]);
        } catch (Exception $e) {
            Log::debug($e);
            return response()
                ->json([
                    'success'   => false
                    ,'msg'      => '시스템 에러'
                    ,'color'    => 'red'
                ]);
        }
    }

    // ---------------------------------
    // 메소드명	: findPw
    // 기능		: 일치하는 정보의 임시 비밀번호를 메일로 발송
    // 파라미터	: Request      $req
    // 리턴값	: json         
    // ---------------------------------
    public function findPw(Request $req) {
        try {
            DB::beginTransaction();

            $user = Userinfo::where('u_email', $req->email)
                ->where('u_name', $req->name)
                ->where('qa_no', $req->qa_no)
                ->where('qa_answer', $req->qa_anw)
                ->first();

            if (!$user) {
                return response()
                ->json([
                    'success'   => false
                    ,'msg'      => '일치하는 정보가 없습니다.'
                    ,'color'    => 'red'
                ]);
            }

            $lower = 'abcdefghijklmnopqrstuvwxyz';
            $upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $special = '!@#$%^*-';
            $numbers = '0123456789';

            $allChars = $lower . $upper . $special . $numbers;
            $tempPw = '';

            // 각 종류의 문자를 하나씩 포함하는지 확인
            $tempPw .= $lower[random_int(0, strlen($lower) - 1)];
            $tempPw .= $upper[random_int(0, strlen($upper) - 1)];
            $tempPw .= $special[random_int(0, strlen($special) - 1)];
            $tempPw .= $numbers[random_int(0, strlen($numbers) - 1)];

            // 나머지 문자를 임의로 추가
            for ($i = 0; $i < 6; $i++) {
                $index = random_int(0, strlen($allChars) - 1);
                $tempPw .= $allChars[$index];
            }

            // 임시 비밀번호를 무작위로 섞기
            $tempPw = str_shuffle($tempPw);

            $user->u_pw = Hash::make($tempPw);
            $user->temp_pw = 1;
            $user->save();

            Mail::to($user->u_email)->send(new FindPassword($user, $tempPw));
            DB::commit();
            return response()
                ->json([
                    'success'   => true
                    ,'msg'      => '입력하신 이메일로 임시 비밀번호가 발송되었습니다.'
                    ,'color'    => 'black'
                ]);
            } catch (Exception $e) {
                DB::rollback();
                Log::debug($e);
                return response()
                    ->json([
                        'success'   => false
                        ,'msg'      => '시스템 에러'
                        ,'color'    => 'red'
                    ]);
            }
    }

    // 마이페이지
    function mypage()
    {
        return view('mypage');
    }
}
