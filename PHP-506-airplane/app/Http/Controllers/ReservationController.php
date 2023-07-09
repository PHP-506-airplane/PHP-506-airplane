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
**************************************************/

namespace App\Http\Controllers;

use App\Mail\SendReserve;
use App\Models\NoticeInfo;
use App\Models\AirportInfo;
use App\Models\FlightInfo;
use App\Models\ReserveInfo;
use App\Models\SeatInfo;
use App\Models\TicketInfo;
use App\Models\Userinfo;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

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
                'ticket.t_price'
            )
            ->get();
    }

    public function dupChk($fly_no, $seat_no) {
        $resedData = 
            ReserveInfo::where('fly_no', $fly_no)
                ->where('seat_no', $seat_no)
                ->first();

        if($resedData) {
            return true;
        }

        return false;
    }

    public function main() {
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
    public function check(Request $req) {
        // 0627 add 이동호
        if(empty(Auth::user())) {
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
    if($req->hd_li_flg === '1'){
        
        $depPort = DB::table('airport_info')
        ->select('*')
        ->where('port_no','=',$req->dep_port_no)->get();

        $arrPort = DB::table('airport_info')
        ->select('*')
        ->where('port_no','=',$req->arr_port_no)->get();

        // 가는편
        $data = DB::table('flight_info')
        ->join('airport_info as dep_port','dep_port.port_no', '=', 'flight_info.dep_port_no')
        ->join('airport_info as arr_port','arr_port.port_no', '=', 'flight_info.arr_port_no')
        ->select(
                'flight_info.*'
                ,'dep_port.port_no AS dep2_port_no'
                ,'dep_port.port_eng AS dep_port_eng'
                ,'dep_port.port_name AS dep_port_name'
                ,'arr_port.port_no AS arr2_port_no'
                ,'arr_port.port_eng AS arr_port_eng'
                ,'arr_port.port_name AS arr_port_name'
                )
        ->where([
            ['flight_info.dep_port_no', '=', $req->dep_port_no],
            ['flight_info.arr_port_no', '=', $req->arr_port_no],
        ])
        ->whereBetween('flight_info.fly_date',[substr($req->fly_date,0,-13),substr($req->fly_date,13)])
        ->limit(5)
        ->get();

        // 오는편
        $data2 = DB::table('flight_info')
        ->join('airport_info as dep_port','dep_port.port_no', '=', 'flight_info.dep_port_no')
        ->join('airport_info as arr_port','arr_port.port_no', '=', 'flight_info.arr_port_no')
        ->select(
                'flight_info.*'
                ,'dep_port.port_no AS dep2_port_no'
                ,'dep_port.port_eng AS dep_port_eng'
                ,'dep_port.port_name AS dep_port_name'
                ,'arr_port.port_no AS arr2_port_no'
                ,'arr_port.port_eng AS arr_port_eng'
                ,'arr_port.port_name AS arr_port_name'
                )
        ->where([
            ['flight_info.dep_port_no', '=', $req->arr_port_no],
            ['flight_info.arr_port_no', '=', $req->dep_port_no],
        ])
        ->whereBetween('flight_info.fly_date',[substr($req->fly_date,0,-13),substr($req->fly_date,13)])
        ->limit(5)
        ->get();

        return view('reservationChk', compact('data', 'data2', 'flg','arrPort','depPort'));

        }else{
            $depPort = DB::table('airport_info')
            ->select('*')
            ->where('port_no','=',$req->one_dep_port_no)->get();

            $arrPort = DB::table('airport_info')
            ->select('*')
            ->where('port_no','=',$req->one_arr_port_no)->get();
        
        // 편도
        $oneway = DB::table('flight_info')
        ->join('airport_info as dep_port','dep_port.port_no', '=', 'flight_info.dep_port_no')
        ->join('airport_info as arr_port','arr_port.port_no', '=', 'flight_info.arr_port_no')
        ->select(
                'flight_info.*'
                ,'dep_port.port_no AS dep2_port_no'
                ,'dep_port.port_eng AS dep_port_eng'
                ,'dep_port.port_name AS dep_port_name'
                ,'arr_port.port_no AS arr2_port_no'
                ,'arr_port.port_eng AS arr_port_eng'
                ,'arr_port.port_name AS arr_port_name'
                )
        ->where([
            ['flight_info.dep_port_no', '=', $req->one_dep_port_no],
            ['flight_info.arr_port_no', '=', $req->one_arr_port_no],
        ])
        ->where('flight_info.fly_date','=',$req->one_fly_date)
        ->limit(5)
        ->get();

        return view('reservationChk', compact('oneway','flg','arrPort','depPort'));
        }

    }

// 좌석 출력
    public function checkpost(Request $req){
        // 0627 add 이동호
        if(empty(Auth::user())) {
            return redirect()->route('users.login')->with('alert', '로그인이 필요한 기능입니다.');
        }
        // Log::debug($req);
        // 왕복/편도 플래그
        $flg = $req->only('hd_li_flg');
        
        $depPort = DB::table('airport_info')
        ->select('*')
        ->where('port_no','=',$req->dep_port_no)->get();
        // Log::debug($depPort);
        
        $arrPort = DB::table('airport_info')
        ->select('*')
        ->where('port_no','=',$req->arr_port_no)->get();
        // Log::debug($arrPort);

        //왕복
        if($req->hd_li_flg =='1'){
            // 가는편
            $data = DB::table('reserve_info as res')
            ->join('flight_info as fli','res.fly_no', '=','fli.fly_no')
            ->join('airport_info as dep','dep.port_no', '=', 'fli.dep_port_no')
            ->join('airport_info as arr','arr.port_no', '=', 'fli.arr_port_no')
            ->select(
                        'fli.*'
                        ,'res.seat_no'
                        ,'dep.port_name as dep_name'
                        ,'dep.port_eng as dep_eng' 
                        ,'arr.port_name as arr_name'
                        ,'arr.port_eng as arr_eng'
                        )
            ->where('fli.fly_no','=',$req->dep_fly_no)
            ->get();

            // 예약된 좌석
            $availableSeats = DB::table('reserve_info')
                ->select('seat_no')
                ->where('fly_no','=',$req->dep_fly_no)
                ->get();
            // 오는편
            $data2 = DB::table('reserve_info as res')
            ->join('flight_info as fli','res.fly_no', '=','fli.fly_no')
            ->join('airport_info as dep','dep.port_no', '=', 'fli.dep_port_no')
            ->join('airport_info as arr','arr.port_no', '=', 'fli.arr_port_no')
            ->select(
                        'fli.*'
                        ,'res.seat_no'
                        ,'dep.port_name as dep_name'
                        ,'dep.port_eng as dep_eng' 
                        ,'arr.port_name as arr_name'
                        ,'arr.port_eng as arr_eng'
                        )
            ->where('fli.fly_no','=',$req->arr_fly_no)
            ->get();

            // 오는편 예약된 좌석
            $availableSeats2 = DB::table('reserve_info')
                ->select('seat_no')
                ->where('fly_no','=',$req->arr_fly_no)
                ->get();

            // 좌석
            $seat = DB::table('seat_info')
            ->select('seat_no')
            ->limit(108)
            ->get();

            if(!isset($req->dep_fly_no)){
                return redirect()->back()->with('alert', '가는편 여정을 선택해주세요.');
            }elseif(!isset($req->arr_fly_no)){
                return redirect()->back()->with('alert', '오는편 여정을 선택해주세요.');
            }
            
            return view('reservationSeat', compact('data', 'data2', 'seat', 'availableSeats', 'availableSeats2', 'flg','depPort','arrPort'));

            }else{
            // 편도
            $data = DB::table('reserve_info as res')
            ->join('flight_info as fli','res.fly_no', '=','fli.fly_no')
            ->join('airport_info as dep','dep.port_no', '=', 'fli.dep_port_no')
            ->join('airport_info as arr','arr.port_no', '=', 'fli.arr_port_no')
            ->select(
                        'fli.*'
                        ,'res.seat_no'
                        ,'dep.port_name as dep_name'
                        ,'dep.port_eng as dep_eng' 
                        ,'arr.port_name as arr_name'
                        ,'arr.port_eng as arr_eng'
                        )
            ->where('fli.fly_no','=',$req->dep_fly_no)
            ->get();

            // 예약된 좌석
            $availableSeats = DB::table('reserve_info')
                ->select('seat_no')
                ->where('fly_no','=',$req->dep_fly_no)
                ->get();

            // 좌석
            $seat = DB::table('seat_info')
            ->select('seat_no')
            ->limit(108)
            ->get();

            if(!isset($req->dep_fly_no)){
                return redirect()->back()->with('alert', '가는편 여정을 선택해주세요.');
            }

            // return view('reservationSeat', compact('data', 'seat', 'availableSeats', 'flg','depPort','arrPort'));
            return redirect()->route('reservation.seatpost')->with('data', 'seat', 'availableSeats', 'flg','depPort','arrPort');
            }
    }
// 예약하기
    public function seatpost(Request $req){
        // 중복결제 방지 v006
        // $resedData = 
        //     ReserveInfo::where('fly_no', $req->fly_no)
        //         ->where('seat_no', $req->seat_no)
        //         ->first();

        // if($resedData) {
        //     // return redirect()->route('reservation.seatpost')->with('alert', '이미 예약된 좌석입니다.');
        //     return redirect()->route('reservation.main')->with('alert', '이미 예약된 좌석입니다.');
        // }
        if ($this->dupChk($req->fly_no, $req->seat_no)) {
            return redirect()->route('reservation.main')->with('alert', '이미 예약된 좌석입니다.');
        }
        if ($this->dupChk($req->fly_no2, $req->seat_no2)) {
            return redirect()->route('reservation.main')->with('alert', '이미 예약된 좌석입니다.');
        }

        $userinfo = Userinfo::where('u_email', Auth::user()->u_email)->first();

        if($req->flg =='1'){

            if ($this->dupChk($req->fly_no, $req->seat_no)) {
                return redirect()->route('reservation.main')->with('alert', '가는편이 이미 예약된 좌석입니다.');
            }
            if ($this->dupChk($req->fly_no2, $req->seat_no2)) {
                return redirect()->route('reservation.main')->with('alert', '오는편이 이미 예약된 좌석입니다.');
            }
            // 가는편 예약
            // 예약정보(reserve_info) 저장
            $reserveInfo = new ReserveInfo([
                'u_no'=> Auth::user()->u_no
                ,'seat_no' => $req->seat_no
                ,'fly_no' => $req->fly_no
                ,'plane_no' => $req->plane_no
            ]);
            
            $reserveInfo->save();

            // 예약정보 저장 후 티켓 저장
            $tNo = $reserveInfo->reserve_no;
            $price = FlightInfo::select('price')
            ->where('fly_no', $req->fly_no)
            ->first();
            $priceInt = intval($price->price);

            $ticketInfo = new TicketInfo([
                'reserve_no'    => $tNo
                ,'t_price'      => $priceInt
            ]);
            $ticketInfo->save();

            $reserveData1 = $this->getReserveData($tNo);
            Mail::to(Auth::user()->u_email)->send(new SendReserve($userinfo, $reserveData1));

            // 오는편 예약
            $reserveInfo2 = new ReserveInfo([
                'u_no'=> Auth::user()->u_no
                ,'seat_no' => $req->seat_no2
                ,'fly_no' => $req->fly_no2
                ,'plane_no' => $req->plane_no2
            ]);

            $reserveInfo2->save();

            $tNo2 = $reserveInfo2->reserve_no;
            $price2 = FlightInfo::select('price')
            ->where('fly_no', $req->fly_no2)
            ->first();
            $priceInt2 = intval($price2->price);

            $ticketInfo2 = new TicketInfo([
                'reserve_no'    => $tNo2
                ,'t_price'      => $priceInt2
            ]);
            $ticketInfo2->save();

            $reserveData2 = $this->getReserveData($tNo2);
            Mail::to(Auth::user()->u_email)->send(new SendReserve($userinfo, $reserveData2));

        }else{
            if ($this->dupChk($req->fly_no, $req->seat_no3)) {
                return redirect()->route('reservation.main')->with('alert', '이미 예약된 좌석입니다.');
            }
            
            // 편도 예약
            $reserveInfo3 = new ReserveInfo([
                'u_no'=> Auth::user()->u_no
                ,'seat_no' => $req->seat_no
                ,'fly_no' => $req->fly_no
                ,'plane_no' => $req->plane_no
            ]);
            $reserveInfo3->save();

            $tNo3 = $reserveInfo3->reserve_no;
            $price3 = FlightInfo::select('price')
            ->where('fly_no', $req->fly_no)
            ->first();
            $priceInt3 = intval($price3->price);

            $ticketInfo3 = new TicketInfo([
                'reserve_no'    => $tNo3
                ,'t_price'      => $priceInt3
            ]);
            $ticketInfo3->save();

            $reserveData = $this->getReserveData($tNo3);
            Mail::to(Auth::user()->u_email)->send(new SendReserve($userinfo, $reserveData));
        }
        

        // v005 add 이동호
        // $tNo = ReserveInfo::max('reserve_no');
        // $price = FlightInfo::select('price')
        //     ->where('fly_no', $req->fly_no)
        //     ->first();
        // $priceInt = intval($price->price);

        // $ticketInfo = new TicketInfo([
        //     'reserve_no'    => $tNo
        //     ,'t_price'      => $priceInt
        // ]);
        // $ticketInfo->save();

        // 메일에 예약정보 담아서 보내기
        // $userinfo = Userinfo::where('u_email', Auth::user()->u_email)->first();

        // $reserveData1 = $this->getReserveData($tNo);
        // $reserveData2 = $this->getReserveData($tNo2);

        // Mail::to(Auth::user()->u_email)->send(new SendReserve($userinfo, $reserveData1));
        // Mail::to(Auth::user()->u_email)->send(new SendReserve($userinfo, $reserveData2));

        return redirect()->route('reservation.myreservation')->with('alert', '예약이 완료되었습니다.\n가입시 등록하신 이메일로 예약정보가 발송되었습니다.');
    }
    
    // v003 이동호 add 나의 예약 조회 페이지
    public function myreservation() {
        if(empty(Auth::user())) {
            // 로그인하지 않은 유저가 접근한 페이지를 세션에 저장
            Session::put('previous_url', route('reservation.myreservation'));
            return redirect()->route('users.login');
        }

        $date = Carbon::now()->subDay();
        $data = 
            ReserveInfo::join('flight_info AS fli', 'reserve_info.fly_no', 'fli.fly_no')
                ->join('airplane_info AS airp', 'fli.plane_no', 'airp.plane_no')
                ->join('airline_info AS airl', 'airp.line_no', 'airl.line_no')
                ->join('airport_info AS dep', 'fli.dep_port_no', 'dep.port_no')
                ->join('airport_info AS arr', 'fli.arr_port_no', 'arr.port_no')
                ->join('user_info AS user', 'reserve_info.u_no', 'user.u_no')
                ->join('ticket_info AS ticket', 'reserve_info.reserve_no', 'ticket.reserve_no')
                ->where('reserve_info.u_no', Auth::user()->u_no)
                ->where('fli.fly_date', '>=', $date)
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
                )
                ->groupBy('fli.fly_no')
                ->orderBy('fli.fly_date')
                ->orderBy('fli.dep_time')
                ->get();

        return view('myreservation')->with('data', $data);
    }

    // v003 이동호 add 예약 취소
    public function rescancle(Request $req) {
        if(empty(Auth::user())) {
            return redirect()->route('users.login');
        }

        ReserveInfo::destroy($req->reserve_no);
        TicketInfo::destroy($req->t_no);
        // TicketInfo::where('t_no', $req->t_no)->delete();

        return redirect()->route('reservation.myreservation')->with('alert', '취소가 완료되었습니다.');
    }
}
