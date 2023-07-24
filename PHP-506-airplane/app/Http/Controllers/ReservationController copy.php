<?php

/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : app/Http/Controllers
 * 파일명       : ReservationController.php
 * 이력         :   v001 0612 오재훈 new
 *                  v002 0614 이동호 add 공지사항
 *                  v003 0620 이동호 add 나의 예약 조회 페이지
 *                  v004 0621 이동호 add 최저가 항공
 *                  v005 0623 이동호 add 메일전송, TicketInfo insert
 *                  v006 0709 이동호 add 중복결제 방지
 *                  v007 0715 이동호 add 트랜잭션
 **************************************************/

namespace App\Http\Controllers;

use App\Mail\SendReserve;
use App\Models\NoticeInfo;
use App\Models\AirportInfo;
use App\Models\FlightInfo;
use App\Models\Mileage;
use App\Models\Payment;
use App\Models\ReserveInfo;
use App\Models\SeatInfo;
use App\Models\TicketInfo;
use App\Models\Userinfo;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use SebastianBergmann\Type\TrueType;

class ReservationController extends Controller
{
    // ---------------------------------
    // 메소드명	: getReserveData
    // 기능		: 예약 정보 데이터를 가져옴
    // 파라미터	:   String      $tNo
    // 리턴값	:   Collection
    // ---------------------------------
    function getReserveData($tNo)
    {
        return ReserveInfo::join('flight_info AS fli', 'reserve_info.fly_no', 'fli.fly_no')
            ->join('airplane_info AS airp', 'fli.plane_no', 'airp.plane_no')
            ->join('airline_info AS airl', 'airp.line_no', 'airl.line_no')
            ->join('airport_info AS dep', 'fli.dep_port_no', 'dep.port_no')
            ->join('airport_info AS arr', 'fli.arr_port_no', 'arr.port_no')
            ->join('user_info AS user', 'reserve_info.u_no', 'user.u_no')
            ->join('ticket_info AS ticket', 'reserve_info.reserve_no', 'ticket.reserve_no')
            ->where('reserve_info.u_no', Auth::user()->u_no)
            ->where('reserve_info.reserve_no', $tNo)
            ->select(
                'reserve_info.*'
                ,'fli.fly_date'
                ,'dep.port_name AS dep_port_name'
                ,'dep.port_eng AS dep_port_eng'
                ,'arr.port_name  AS arr_port_name'
                ,'arr.port_eng AS arr_port_eng'
                ,'fli.flight_num'
                ,'fli.dep_time'
                ,'fli.arr_time'
                ,'airp.plane_name'
                ,'airl.line_name'
                ,'airl.line_code'
                ,'user.u_name'
                ,'fli.fly_no'
                ,'ticket.t_no'
                ,'ticket.t_price'
            )
            ->get();
    }

    // ---------------------------------
    // 메소드명	: dupChk
    // 기능		: 예약된 좌석을 확인
    // 파라미터	: Int       $fly_no
    //            String    $seat_no
    // 리턴값	: json      bool
    // ---------------------------------
    public function dupChk($fly_no, $seat_no)
    {
        try {
            $dup = ReserveInfo::where('fly_no', $fly_no)
                ->where('seat_no', $seat_no)
                ->exists();
            return response()->json(['is_duplicate' => $dup]);
        } catch (QueryException $e) {
            return response()->json(['msg' => 'API Error \n' . $e->getMessage()], 500);
        }
    }

    // ---------------------------------
    // 메소드명	: caching
    // 기능		: 운항정보PK와 좌석번호로 캐시를 생성
    // 파라미터	: Request      $req
    // 리턴값	: json         bool
    // ---------------------------------
    public function caching(Request $req) {
        try {
            // 캐시 키 생성
            $cacheKey = 'res_' . $req->fly_no . '_' . $req->seat_no;
            $isRes = Cache::get($cacheKey);
            Log::debug('캐시확인 : ', [Cache::get($cacheKey)]);

            Log::debug($isRes);
            if (!$isRes) {
                // 캐시 생성
                Cache::put($cacheKey, 1);
                Log::debug('캐시생성 : ', [Cache::get($cacheKey)]);
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false]);
            }
        } catch (Exception $e) {
            // 예외 처리
            Log::error('캐시생성 실패 : ' . $e->getMessage());
            return response()->json(['error' => 'Caching failed'], 500);
        }
    }

    // ---------------------------------
    // 메소드명	: clearCache
    // 기능		: 운항정보PK와 좌석번호로 생성된 캐시를 삭제
    // 파라미터	: Request      $req
    // 리턴값	: json         bool
    // ---------------------------------
    public function clearCache(Request $req) {
        try {
            // 캐시 키 생성
            $cacheKey = 'res_' . $req->fly_no . '_' . $req->seat_no;

            // 캐시 삭제
            Cache::forget($cacheKey);

            return response()->json(['success' => true]);
        } catch (Exception $e) {
            // 예외 처리
            Log::error('캐시 지우기 실패 : ' . $e->getMessage());
            return response()->json(['error' => 'Cache clearing failed'], 500);
        }
    }

    // ---------------------------------
    // 메소드명	: getSeats
    // 기능		: 항공편 PK를 기반으로 좌석정보를 가져옴
    // 파라미터	: 
    // 리턴값	: 
    // ---------------------------------
    public function getSeats($fly_no) {
        $data = ReserveInfo::join('flight_info as fli', 'reserve_info.fly_no', 'fli.fly_no')
            ->join('airport_info as dep', 'dep.port_no', 'fli.dep_port_no')
            ->join('airport_info as arr', 'arr.port_no', 'fli.arr_port_no')
            ->select(
                'fli.*'
                ,'reserve_info.seat_no'
                ,'dep.port_name as dep_name'
                ,'dep.port_eng as dep_eng'
                ,'arr.port_name as arr_name'
                ,'arr.port_eng as arr_eng'
            )
            ->where('fli.fly_no', $fly_no)
            ->get();

            // 예약된 좌석
        $availableSeats = ReserveInfo::select('seat_no')
            ->where('fly_no', $fly_no)
            ->get();
        
        return [$data, $availableSeats];
    }


    // ---------------------------------
    // 메소드명	: saveReservation
    // 기능		: 예약 정보를 저장
    // 파라미터	: Arry      $data
    // 리턴값	: int       $tNo
    // ---------------------------------
    public function saveReservation($data)
    {
        $reserveInfo = new ReserveInfo([
            'u_no'      => Auth::user()->u_no
            ,'seat_no'  => $data['seat_no']
            ,'fly_no'   => $data['fly_no']
            ,'plane_no' => $data['plane_no']
        ]);

        $reserveInfo->save();

        $tNo = $reserveInfo->reserve_no;
        $price = FlightInfo::select('price')
            ->where('fly_no', $data['fly_no'])
            ->first();
        $priceInt = intval($price->price);

        $ticketInfo = new TicketInfo([
            'reserve_no' => $tNo
            ,'t_price'   => $priceInt
        ]);

        $ticketInfo->save();

        $user = Auth::user()->u_no;
        $merchant_uid = $data['merchant_uid'];

        $payment = new Payment([
            'u_no'          => $user
            ,'price'        => $priceInt
            ,'reserve_no'   => $tNo
            ,'merchant_uid' => $merchant_uid
        ]);

        $payment->save();

        $mileage = $priceInt * 0.05;
        $userMile = Mileage::where('u_no', $user)->first();

        if ($userMile) {
            $userMile->u_mile += $mileage;
        } else {
            $userMile = new Mileage([
                'u_no' => $user
                ,'u_mile' => $mileage
            ]);
        }

        $userMile->save();

        return $tNo;
    }

    public function main()
    {
        // $result = AirportInfo::select('*')->get(); //v002 del 이동호
        $data =
            AirportInfo::select('*')
            ->orderby('port_name')
            ->get();

        // v002 add 이동호
        // 최신 공지사항 5개 가져오기
        $notices =
            NoticeInfo::select('notice_title', 'notice_no', 'created_at')
            ->orderBy('notice_no', 'desc')
            ->take(5)
            ->get();

        // v004 이동호
        // 최저가항공 가져오기

        $lowCost =
            FlightInfo::join('airport_info AS dep', 'flight_info.dep_port_no', 'dep.port_no')
            ->join('airport_info AS arr', 'flight_info.arr_port_no', 'arr.port_no')
            ->select(
                'flight_info.fly_no'
                ,'flight_info.fly_date'
                ,'flight_info.price'
                ,'dep.port_name AS dep_name'
                ,'dep.port_no AS dep_no'
                ,'arr.port_name AS arr_name'
                ,'arr.port_no AS arr_no'
                ,'flight_info.plane_no'
            )
            ->where('flight_info.fly_date', '>', now())
            ->orderBy('price')
            ->orderBy('flight_info.fly_date')
            ->limit(8)
            ->get();

        // $lowCost = [];
        // for($i = 0; $i < 8; $i++) {
        //     $price = rand(10, 30) * 1000;
        //     $lowCost[] = 
        //         FlightInfo::join('airport_info AS dep', 'flight_info.dep_port_no', 'dep.port_no')
        //             ->join('airport_info AS arr', 'flight_info.arr_port_no', 'arr.port_no')
        //             ->select(
        //                 'flight_info.fly_no'
        //                 ,'flight_info.fly_date'
        //                 ,'flight_info.price'
        //                 ,'dep.port_name AS dep_name'
        //                 ,'dep.port_no AS dep_no'
        //                 ,'arr.port_name AS arr_name'
        //                 ,'arr.port_no AS arr_no'
        //                 ,'flight_info.plane_no'
        //             )
        //             ->where('flight_info.fly_date', '>', now())
        //             ->where('flight_info.price', '=', $price)
        //             ->first();
        // }

        //  return view('welcome')->with('data',$result); //v002 del 이동호
        return view('welcome', compact('notices', 'data', 'lowCost'));
    }

    // 항공편 설정
    public function check(Request $req)
    {
        Log::debug($req);
        // 0627 add 이동호
        if (empty(Auth::user())) {
            Session::put(['request' => $req->all()]);
            //요청, 접근하려고 했던 페이지 담음
            //put(이름, 값)
            Session::put('previous_url', route('reservation.check'));
            return redirect()->route('users.login')->with('alert', '로그인이 필요한 기능입니다.');
        }

        $sessionReq = Session::get('request');
        Session::forget('request');

        if ($sessionReq !== null) {
            $req = new Request($sessionReq);
            $_GET['fly_date'] = $req->fly_date;
            $_GET['ADULT'] = $req->ADULT;
            $_GET['CHILD'] = $req->CHILD;
            $_GET['BABY'] = $req->BABY;
        }


        // cookie ver. ------------------------------------------------------------------------
        // 요청 쿠키 가져오기
        // $prevReq = Cookie::get('prev_req');
        // Log::debug(['요청쿠키', $prevReq]);

        // if (!Auth::user()) {
        //     Log::debug($prevReq, ['1차 if']);
        //     // 이전 요청 쿠키가 없으면 새로운 요청을 쿠키에 저장
        //     if (empty($prevReq)) {
        //         Cookie::queue('prev_req', serialize($req->all()), 5);
        //         Cookie::queue('prev_url', route('reservation.check'), 5);
        //         Log::debug(cookie('prev_req'), ['쿠키에 담기']);
        //         Log::debug(cookie('prev_url'), ['쿠키에 담기']);
        //     }
        //     return redirect()->route('users.login')->with('alert', '로그인이 필요한 기능입니다.');
        // }

        // // 요청 쿠키가 있을 경우
        // if (!empty($prevReq)) {
        //     $prevReqArr = unserialize($prevReq);
        //     $req = new Request($prevReqArr);
        //     $_GET['fly_date'] = $req->fly_date;

        //     // 요청 쿠키 삭제
        //     Cookie::forget('prev_req', 'prev_url');
        // }
        // /cookie ver. ------------------------------------------------------------------------

        // Log::debug($req);

        // 왕복/편도 플래그
        $flg = $req->only('hd_li_flg');
        // 왕복
        if ($req->hd_li_flg === '1') {

            $depPort = DB::table('airport_info')
                ->select('*')
                ->where('port_no', '=', $req->dep_port_no)->get();

            $arrPort = DB::table('airport_info')
                ->select('*')
                ->where('port_no', '=', $req->arr_port_no)->get();

            // 가는편
            $data = DB::table('flight_info')
                ->join('airport_info as dep_port', 'dep_port.port_no', '=', 'flight_info.dep_port_no')
                ->join('airport_info as arr_port', 'arr_port.port_no', '=', 'flight_info.arr_port_no')
                ->select(
                    'flight_info.*',
                    'dep_port.port_no AS dep2_port_no',
                    'dep_port.port_eng AS dep_port_eng',
                    'dep_port.port_name AS dep_port_name',
                    'arr_port.port_no AS arr2_port_no',
                    'arr_port.port_eng AS arr_port_eng',
                    'arr_port.port_name AS arr_port_name'
                )
                ->where([
                    ['flight_info.dep_port_no', '=', $req->dep_port_no],
                    ['flight_info.arr_port_no', '=', $req->arr_port_no],
                ])
                ->whereBetween('flight_info.fly_date', [substr($req->fly_date, 0, -13), substr($req->fly_date, 13)])
                ->limit(5)
                ->get();

            // 오는편
            $data2 = DB::table('flight_info')
                ->join('airport_info as dep_port', 'dep_port.port_no', '=', 'flight_info.dep_port_no')
                ->join('airport_info as arr_port', 'arr_port.port_no', '=', 'flight_info.arr_port_no')
                ->select(
                    'flight_info.*',
                    'dep_port.port_no AS dep2_port_no',
                    'dep_port.port_eng AS dep_port_eng',
                    'dep_port.port_name AS dep_port_name',
                    'arr_port.port_no AS arr2_port_no',
                    'arr_port.port_eng AS arr_port_eng',
                    'arr_port.port_name AS arr_port_name'
                )
                ->where([
                    ['flight_info.dep_port_no', '=', $req->arr_port_no],
                    ['flight_info.arr_port_no', '=', $req->dep_port_no],
                ])
                ->whereBetween('flight_info.fly_date', [substr($req->fly_date, 0, -13), substr($req->fly_date, 13)])
                ->limit(5)
                ->get();

            return view('reservationChk', compact('data', 'data2', 'flg', 'arrPort', 'depPort'));
        } else {
            $depPort = DB::table('airport_info')
                ->select('*')
                ->where('port_no', '=', $req->one_dep_port_no)->get();

            $arrPort = DB::table('airport_info')
                ->select('*')
                ->where('port_no', '=', $req->one_arr_port_no)->get();

            // 편도
            $oneway = DB::table('flight_info')
                ->join('airport_info as dep_port', 'dep_port.port_no', '=', 'flight_info.dep_port_no')
                ->join('airport_info as arr_port', 'arr_port.port_no', '=', 'flight_info.arr_port_no')
                ->select(
                    'flight_info.*',
                    'dep_port.port_no AS dep2_port_no',
                    'dep_port.port_eng AS dep_port_eng',
                    'dep_port.port_name AS dep_port_name',
                    'arr_port.port_no AS arr2_port_no',
                    'arr_port.port_eng AS arr_port_eng',
                    'arr_port.port_name AS arr_port_name'
                )
                ->where([
                    ['flight_info.dep_port_no', '=', $req->one_dep_port_no],
                    ['flight_info.arr_port_no', '=', $req->one_arr_port_no],
                ])
                ->where('flight_info.fly_date', '=', $req->one_fly_date)
                ->limit(5)
                ->get();

            return view('reservationChk', compact('oneway', 'flg', 'arrPort', 'depPort'));
        }
    }

    // 좌석 출력
    public function checkpost(Request $req)
    {
        Log::debug('req : ', $req->all());
        // 예시로 사용자가 선택한 인원 수와 해당 인원들의 이름을 받아왔다고 가정
        $adultCount = intval($_POST['ADULT']);
        $childCount = intval($_POST['CHILD']);

        // 사용자가 입력한 인원에 따라 각 인원들의 이름을 담을 배열을 생성
        $names = [];

        // 성인, 유아, 소아 인원 수에 따라 이름 배열에 이름을 추가
        for ($i = 1; $i <= $adultCount; $i++) {
            $names[] = "성인{$i}"; // 성인 이름 추가
        }

        for ($i = 1; $i <= $childCount; $i++) {
            $names[] = "소아{$i}"; // 유아 이름 추가
        }

        // Log::debug($req);
        $pass_name = $names; 
        $peoNum = $adultCount + $childCount;
        

        // 0627 add 이동호
        if (empty(Auth::user())) {
            return redirect()->route('users.login')->with('alert', '로그인이 필요한 기능입니다.');
        }
        // Log::debug($req);
        // 왕복/편도 플래그
        $flg = $req->only('hd_li_flg');

        $depPort = DB::table('airport_info')
            ->select('*')
            ->where('port_no', '=', $req->dep_port_no)->get();
        // Log::debug($depPort);

        $arrPort = DB::table('airport_info')
            ->select('*')
            ->where('port_no', '=', $req->arr_port_no)->get();
        // Log::debug($arrPort);

        //왕복
        if ($req->hd_li_flg == '1') {
            // 가는편
            // $data = DB::table('reserve_info as res')
            //     ->join('flight_info as fli', 'res.fly_no', '=', 'fli.fly_no')
            //     ->join('airport_info as dep', 'dep.port_no', '=', 'fli.dep_port_no')
            //     ->join('airport_info as arr', 'arr.port_no', '=', 'fli.arr_port_no')
            //     ->select(
            //         'fli.*',
            //         'res.seat_no',
            //         'dep.port_name as dep_name',
            //         'dep.port_eng as dep_eng',
            //         'arr.port_name as arr_name',
            //         'arr.port_eng as arr_eng'
            //     )
            //     ->where('fli.fly_no', '=', $req->dep_fly_no)
            //     ->get();

            // // 예약된 좌석
            // $availableSeats = DB::table('reserve_info')
            //     ->select('seat_no')
            //     ->where('fly_no', '=', $req->dep_fly_no)
            //     ->get();

            list($data, $availableSeats) = $this->getSeats($req->dep_fly_no);
            list($data2, $availableSeats2) = $this->getSeats($req->arr_fly_no);

            // Log::debug('data : ', [$data]);
            // Log::debug('data2 : ', [$data2]);
            // Log::debug('availableSeats : ', [$availableSeats]);
            // Log::debug('availableSeats2 : ', [$availableSeats2]);
            // 오는편

            // $data2 = DB::table('reserve_info as res')
            //     ->join('flight_info as fli', 'res.fly_no', '=', 'fli.fly_no')
            //     ->join('airport_info as dep', 'dep.port_no', '=', 'fli.dep_port_no')
            //     ->join('airport_info as arr', 'arr.port_no', '=', 'fli.arr_port_no')
            //     ->select(
            //         'fli.*',
            //         'res.seat_no',
            //         'dep.port_name as dep_name',
            //         'dep.port_eng as dep_eng',
            //         'arr.port_name as arr_name',
            //         'arr.port_eng as arr_eng'
            //     )
            //     ->where('fli.fly_no', '=', $req->arr_fly_no)
            //     ->get();

            // // 오는편 예약된 좌석
            // $availableSeats2 = DB::table('reserve_info')
            //     ->select('seat_no')
            //     ->where('fly_no', '=', $req->arr_fly_no)
            //     ->get();

            // 좌석
            $seat = SeatInfo::select('seat_no')
                ->limit(108)
                ->get();

            if (!isset($req->dep_fly_no)) {
                return redirect()->back()->with('alert', '가는편 여정을 선택해주세요.');
            } elseif (!isset($req->arr_fly_no)) {
                return redirect()->back()->with('alert', '오는편 여정을 선택해주세요.');
            }

            Log::debug('data : ', [$data]);
            Log::debug('data2 : ', [$data2]);
            Log::debug('seat : ', [$seat]);
            Log::debug('availableSeats : ', [$availableSeats]);
            Log::debug('availableSeats2 : ', [$availableSeats2]);
            Log::debug('depPort : ', [$depPort]);
            Log::debug('arrPort : ', [$arrPort]);
            Log::debug('peoNum : ', [$peoNum]);
            Log::debug('pass_name : ', [$pass_name]);

            return view('reservationSeat', compact('data', 'data2', 'seat', 'availableSeats', 'availableSeats2', 'flg', 'depPort', 'arrPort','peoNum','pass_name'));
        } else {
            // 편도
            $data = DB::table('reserve_info as res')
                ->join('flight_info as fli', 'res.fly_no', '=', 'fli.fly_no')
                ->join('airport_info as dep', 'dep.port_no', '=', 'fli.dep_port_no')
                ->join('airport_info as arr', 'arr.port_no', '=', 'fli.arr_port_no')
                ->select(
                    'fli.*',
                    'res.seat_no',
                    'dep.port_name as dep_name',
                    'dep.port_eng as dep_eng',
                    'arr.port_name as arr_name',
                    'arr.port_eng as arr_eng'
                )
                ->where('fli.fly_no', '=', $req->dep_fly_no)
                ->get();

            // 예약된 좌석
            $availableSeats = DB::table('reserve_info')
                ->select('seat_no')
                ->where('fly_no', '=', $req->dep_fly_no)
                ->get();

            // 좌석
            $seat = DB::table('seat_info')
                ->select('seat_no')
                ->limit(108)
                ->get();

            if (!isset($req->dep_fly_no)) {
                return redirect()->back()->with('alert', '가는편 여정을 선택해주세요.');
            }
            return view('reservationSeat', compact('data', 'seat', 'availableSeats', 'flg','depPort','arrPort'));
        }
    }
    // 예약하기
    public function seatpost(Request $req)
    {
        Log::debug('--------- seatpost Start ---------');
        Log::debug('request all', $req->all());
        // ---------------------
        // "fly_no":"5248"
        // ,"merchant_uid":"nobody_1690195146330"
        // ,"plane_no":"22"
        // ,"ADULT":"1"
        // ,"CHILD":"1"
        // ,"BABY":"1"
        // ,"fly_no2":"17215"
        // ,"plane_no2":"0"
        // ,"p_name":"유아"
        // ,"p_birth":null
        // ,"p_gender":"0","seat_no":["A02","A03"],"seats_no":["A01","A02"]
        // ---------------------
        try {

        } catch (Exception $e) {
            Log::debug('--------- seatpost catch ---------', [$e]);
            return redirect()->back()->with('alert', '서버 오류가 발생했습니다.\n잠시후 다시 시도해주세요.');
        }
        // return redirect()->route('reservation.myreservation')->with('alert', '예약이 완료되었습니다.\n가입시 등록하신 이메일로 예약정보가 발송되었습니다.');


        // // 이메일 보내기 위한 유저 정보 저장
        // $userinfo = Userinfo::where('u_email', Auth::user()->u_email)->first();
        // // 가는편 좌석
        // $dep_seats = $req->seat_no;
        // // 오는편 좌석
        // $arr_seats = $req->seats_no; 

        // // 왕복
        // if ($req->flg == '1') {
        //     Log::debug('flg : 1');
        //     try {
            
        //         DB::beginTransaction();

        //         // 가는편
        //         // for($i=0; $i<count($dep_seats); $i++){
        //             foreach ($req->all() as $data ) {
        //                 $cacheKeys = [];
        //                 $int_fly = strval($data->fly_no);
        //                 $cacheKeys = [
        //                     'res_' . $int_fly . '_' . $data->seat_no,
        //                 ];
        //                 Log::debug('cacheKeys',$cacheKeys);
        //                 $flightData = 
        //                 [
        //                     'seat_no' => $data->seat_no
        //                     ,'fly_no' => $int_fly
        //                     ,'plane_no' => $data->plane_no
        //                     ,'merchant_uid' => $data->merchant_uid
        //                 ];
        //                 Log::debug('flightData',$flightData);
        //             }
        //         // }
        //         // 오는편
        //         // for($i=0; $i<count($arr_seats); $i++){
        //         //     $cacheKeys1 = [];
        //         //     $cacheKeys1 = [
        //         //         'res_' . $req->fly_no2 . '_' . $req->seats_no[$i],
        //         //     ];
        //         //     Log::debug('cacheKeys1',$cacheKeys1);
        //         //     $flightData = [
        //         //         'seat_no' => $req->seats_no[$i]
        //         //         ,'fly_no' => $req->fly_no2
        //         //         ,'plane_no' => $req->plane_no2
        //         //         ,'merchant_uid' => $req->merchant_uid
        //         //     ];
        //         // }
                
        //         $reserveNos = [];
        //         foreach ($flightData as $data) {
        //             $reserveNo = $this->saveReservation($data);
        //             $reserveNos[] = $reserveNo;
        //         }

        //         $reserveNos = [$reserveNos[0], $reserveNos[1]]; // 각 예약 번호를 배열로 저장

        //         foreach ($reserveNos as $reserveNo) {
        //             $resData = $this->getReserveData($reserveNo);
        //             // Mail::to(Auth::user()->u_email)->send(new SendReserve($userinfo, $resData));
        //             Mail::to(Auth::user()->u_email)->queue(new SendReserve($userinfo, $resData));
        //         }
        //         Log::debug('message',$cacheKeys);
        //         // foreach ($cacheKeys as $cacheKey) {
        //             Cache::forget($cacheKeys);
        //             // Cache::forget($cacheKeys1);
        //         // }
        //         DB::commit();
        //     } catch (Exception $e) {
        //         DB::rollBack();
        //         Log::error($e);
        //         // foreach ($cacheKeys as $cacheKey) {
        //             Cache::forget($cacheKeys);
        //         // }
        //         return redirect()->route('reservation.main')->with('alert', '예약중 오류가 발생했습니다.');
        //     }
        // } else {
        //     Log::debug('flg : 0');
        //     try {
        //         DB::beginTransaction();

        //         $flightData = [
        //             'seat_no' => $req->seat_no
        //             ,'fly_no' => $req->fly_no
        //             ,'plane_no' => $req->plane_no
        //         ];

        //         $reserveNo = $this->saveReservation($flightData);

        //         $resData = $this->getReserveData($reserveNo);
        //         Mail::to(Auth::user()->u_email)->send(new SendReserve($userinfo, $resData));

        //         $cacheKey = 'res_' . $req->fly_no . '_' . $req->seat_no;
        //         Cache::forget($cacheKey);

        //         DB::commit();
        //     } catch (Exception $e) {
        //         DB::rollBack();
        //         Log::error($e);
        //         Cache::forget($cacheKey);
        //         Log::debug('--------- seatpost End (Error)---------');
        //         return redirect()->route('reservation.main')->with('alert', '예약중 오류가 발생했습니다.');
        //     }
        // }
        // Log::debug('--------- seatpost End ---------');
        // return redirect()->route('reservation.myreservation')->with('alert', '예약이 완료되었습니다.\n가입시 등록하신 이메일로 예약정보가 발송되었습니다.');
    }

    // v003 이동호 add 나의 예약 조회 페이지
    public function myreservation()
    {

        if (empty(Auth::user())) {
            // 로그인하지 않은 유저가 접근한 페이지를 세션에 저장
            Session::put('previous_url', route('reservation.myreservation'));
            return redirect()->route('users.login');
        }
        //지금 로그인 돼있는 엘로퀀트의 u_no만 뽑음
        $user  = Userinfo::find(Auth::user()->u_no);

        $date = Carbon::now()->subDay();
        $data =
            ReserveInfo::join('flight_info AS fli', 'reserve_info.fly_no', 'fli.fly_no')
            ->join('airplane_info AS airp', 'fli.plane_no', 'airp.plane_no')
            ->join('airline_info AS airl', 'airp.line_no', 'airl.line_no')
            ->join('airport_info AS dep', 'fli.dep_port_no', 'dep.port_no')
            ->join('airport_info AS arr', 'fli.arr_port_no', 'arr.port_no')
            ->join('user_info AS user', 'reserve_info.u_no', 'user.u_no')
            ->join('ticket_info AS ticket', 'reserve_info.reserve_no', 'ticket.reserve_no')
            ->join('payment as pay', 'pay.reserve_no','reserve_info.reserve_no')
            ->where('reserve_info.u_no', Auth::user()->u_no)
            ->where('fli.fly_date', '>=', $date)
            ->select(
                'reserve_info.*',
                'fli.fly_date',
                'dep.port_name AS dep_port_name',
                'dep.port_eng AS dep_port_eng',
                'arr.port_name  AS arr_port_name',
                'arr.port_eng AS arr_port_eng',
                'fli.flight_num',
                'fli.dep_time',
                'fli.arr_time',
                'airp.plane_name',
                'airl.line_name',
                'airl.line_code',
                'user.u_name',
                'fli.fly_no',
                'ticket.t_no',
                'pay.merchant_uid',
                'pay.id',
                'pay.price'
            )
            // ->groupBy('fli.fly_no')
            ->orderBy('fli.fly_date')
            ->orderBy('fli.dep_time')
            ->get();

        return view('myreservation', compact('data', 'user'));
    }

    public function getToken(){
        // 엑세스 토큰 발급
        $result  = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post('https://api.iamport.kr/users/getToken', [
            'imp_key' => '0833844628848866',
            'imp_secret' => 'l17oW36JAtRW7TaNjsZeBTLwdM0XbIFYJysHLDYzSBdn3yDgkDIM36G75yQ29SImMWw130HxvvbzIJNv',
        ]);
        $arr_result = json_decode($result, true);
        return $arr_result["response"]["access_token"];
    }
    

    // v003 이동호 add 예약 취소
    public function rescancle(Request $req)
    {
        if (empty(Auth::user())) {
            return redirect()->route('users.login');
        }

        // v007 add 트랜잭션
        DB::beginTransaction();
        try {
            // ---------------------------환불--------------------------
        // 생성된 토큰 가져옴
        $accessToken = $this->getToken();
        // Log::debug('access Token', [$accessToken]);
        // 환불하려는 결제 정보를 아임포트의 payment_id를 기준으로 데이터베이스에서 조회합니다.

        // Log::alert($paymentInfo);
        // $userName = auth()->user()->u_name;

        // 결제 정보가 없거나 이미 환불된 경우 등 예외 상황을 처리합니다.
        // if (!$req->merchant_uid || $paymentInfo->refunded) {
        //     // 환불할 수 없는 경우에 대한 처리를 여기에 추가합니다.
        //     return response()->json(['message' => '환불할 수 없는 결제 정보입니다.'], 400);
        // }
        Log::debug($req);
        // try{
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => $accessToken
            ])->post("https://api.iamport.kr/payments/cancel", [
                'merchant_uid' => $req->merchant_uid, // 주문번호
                'amount' => $req->price, // 환불할 금액
                'reason' => '고객 요청에 의한 환불', // 환불 사유
            ]);
            // Log::debug($response);
            // 아임포트 API로 환불 요청을 보냅니다.
            // 아임포트 API의 응답을 확인하고, 환불 결과에 따라 처리합니다.
            // if ($response->successful()) {
            //     // 환불 성공
            //     // 환불 정보를 데이터베이스에 저장하거나 환불 처리를 기록하는 등의 작업을 수행합니다.
            //     // 예를 들어, $paymentInfo->update(['refunded' => true]) 등의 코드를 추가할 수 있습니다.
            //     return response()->json(['message' => '환불이 성공적으로 완료되었습니다.']);
            // } else {
            //     // 환불 실패
            //     // 환불 실패에 대한 처리를 여기에 추가합니다.
            //     $errorMessage = $response['message'] ?? '환불에 실패하였습니다.';
            //     return response()->json(['message' => $errorMessage], $response->status());
            // }
            
        // }catch (Exception $e){
        //     Log::error($e);
        //     return response()->json(['message' => '환불에 실패하였습니다.'], 500);
        // }
        // end ---------------------------환불--------------------------

            ReserveInfo::where('reserve_no', $req->reserve_no)->delete();
            TicketInfo::where('reserve_no', $req->reserve_no)->delete();
            Payment::where('merchant_uid', $req->merchant_uid)->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);
            return redirect()->route('reservation.main')->with('alert', '예약 취소중 오류가 발생했습니다.');
        }

        // ReserveInfo::destroy($req->reserve_no);
        // TicketInfo::destroy($req->t_no);
        // TicketInfo::where('t_no', $req->t_no)->delete();

        return redirect()->route('reservation.myreservation')->with('alert', '취소가 완료되었습니다.');
    }

    public function peoInsert(Request $req) {
        $peoNum = intval($req->ADULT) + intval($req->CHILD) + intval($req->BABY);
        // 예시로 사용자가 선택한 인원 수와 해당 인원들의 이름을 받아왔다고 가정
        $adultCount = intval($req->ADULT);
        $childCount = intval($req->CHILD);
        $babyCount = intval($req->BABY);
        // 사용자가 입력한 인원에 따라 각 인원들의 이름을 담을 배열을 생성
        $names = [];
        // 성인, 유아, 소아 인원 수에 따라 이름 배열에 이름을 추가
        for ($i = 1; $i <= $adultCount; $i++) {
            $names[] = "성인{$i}"; // 성인 이름 추가
        }
        for ($i = 1; $i <= $childCount; $i++) {
            $names[] = "소아{$i}"; // 소아 이름 추가
        }
        for ($i = 1; $i <= $babyCount; $i++) {
            $names[] = "유아{$i}"; // 유아 이름 추가
        }
        // Log::debug($req);
        $pass_name = $names;
        $seat_dep_no = $req->seat_no_go;
        $seat_arr_no = $req->seat_no_return;

        

        return view('reserveInsert', compact('peoNum','pass_name','seat_dep_no','seat_arr_no'));
    }


}


