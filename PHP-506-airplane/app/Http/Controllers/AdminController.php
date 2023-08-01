<?php
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : Http/Controller
 * 파일명       : AdmionController.php
 * 이력         :   v001 0721 이동호 new
**************************************************/

namespace App\Http\Controllers;

use App\Http\Middleware\AdminPageMiddleware;
use App\Mail\ResCancel;
use App\Models\AirLineInfo;
use App\Models\AirportInfo;
use App\Models\FlightInfo;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use App\Jobs\SendEmailCancel;
use App\Mail\SendEmailDelay;
use App\Models\AirplaneInfo;
use App\Models\FlightInfoView;
use App\Models\Payment;
use App\Models\ReserveInfo;
use App\Models\TicketInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    protected $today;
    protected $airLine;
    protected $airPlanes;
    protected $port;

    // ---------------------------------
    // 메소드명	: __construct()
    // 기능		: 공통으로 사용하는 데이터를 생성
    // 파라미터	: 없음
    // 리턴값	: 없음
    // ---------------------------------
    public function __construct() {
        // 미들웨어로 관리자권한 체크
        $this->middleware(AdminPageMiddleware::class);
        $this->today        = Carbon::now()->toDateString();
        $this->airLine      = AirLineInfo::get();
        $this->airPlanes    = AirplaneInfo::join('airline_info AS airl', 'airplane_info.line_no', 'airl.line_no')->get();
        $this->port         = AirportInfo::get();
    }

    // ---------------------------------
    // 메소드명	: index()
    // 기능		: 리스트 페이지로 리다이렉트
    // 파라미터	: 없음
    // 리턴값	: 
    // ---------------------------------
    public function index() {
        // 모든(deleted_at !== null인 데이터 포함) 운항정보 데이터를 select
        $data =  FlightInfo::leftJoin('reserve_info AS res', 'flight_info.fly_no', 'res.fly_no')
            ->join('airport_info AS dep', 'flight_info.dep_port_no', 'dep.port_no')
            ->join('airport_info AS arr', 'flight_info.arr_port_no', 'arr.port_no')
            ->join('airplane_info AS plane', 'flight_info.plane_no', 'plane.plane_no')
            ->join('airline_info AS line', 'plane.line_no', 'line.line_no')
            ->select(
                'flight_info.*'
                ,'dep.port_name AS dep_port_name'
                ,'arr.port_name AS arr_port_name'
                ,'line.line_name'
                ,DB::raw('COUNT(res.fly_no) AS count')
                ,'plane.total_seat_num'
            )
            ->where('flight_info.fly_date', '>', Carbon::now()->subDay())
            ->withTrashed()
            ->groupBy('flight_info.fly_no')
            ->orderBy('flight_info.fly_date')
            ->orderBy('flight_info.dep_time')
            ->paginate(10);
        // $data = FlightInfoView::paginate(10);

        return view('admin')
            ->with('today', $this->today)
            ->with('airLine', $this->airLine)
            ->with('airPlane', $this->airPlanes)
            ->with('port', $this->port)
            ->with('data', $data);
    }

    // ---------------------------------
    // 메소드명	: search()
    // 기능		: 리스트 페이지에 검색결과 출력
    // 파라미터	: Request       $req
    // 리턴값	: 
    // ---------------------------------
    public function search(Request $req) {
        // Log::debug($req);
        try {
            $dateStart  = $req->dateStart;
            $dateEnd    = $req->dateEnd;
            $airline    = $req->airline;
            $depPort    = $req->depPort;
            $arrPort    = $req->arrPort;
            $state      = $req->state;
    
            // 조건에 맞는 운항 정보 검색
            $data = FlightInfo::leftJoin('reserve_info AS res', 'flight_info.fly_no', 'res.fly_no')
                ->join('airport_info AS dep', 'flight_info.dep_port_no', 'dep.port_no')
                ->join('airport_info AS arr', 'flight_info.arr_port_no', 'arr.port_no')
                ->join('airplane_info AS plane', 'flight_info.plane_no', 'plane.plane_no')
                ->join('airline_info AS line', 'plane.line_no', 'line.line_no')
                ->select(
                    'flight_info.*'
                    ,'dep.port_name AS dep_port_name'
                    ,'arr.port_name AS arr_port_name'
                    ,'line.line_name'
                    ,'line.line_no'
                    ,DB::raw('COUNT(res.fly_no) AS count')
                    ,'plane.total_seat_num'
                )
                ->whereBetween('fly_date', [$dateStart, $dateEnd]);

            // 항공사 select box가 전체가 아닐경우 해당하는 항공사만 검색
            if ($airline !== '0') {
                $data->where('line.line_no', $airline);
            }

            // 출발공항 select box가 전체가 아닐경우 해당하는 출발공항만 검색
            if ($depPort !== '0') {
                $data->where('dep_port_no', $depPort);
            }

            // 도착공항 select box가 전체가 아닐경우 해당하는 도착공항만 검색
            if ($arrPort !== '0') {
                $data->where('arr_port_no', $arrPort);
            }

            // 결항여부가 "정상"일 경우 결항되지 않은 데이터만 검색
            if ($state === '1') {
                $data->whereNull('deleted_at');
            // 결항여부가 "결항"일 경우 결항된 데이터만 검색
            } else if ($state === '2') {
                $data->whereNotNull('deleted_at');
            }

            $data = $data->withTrashed()
                ->groupBy('flight_info.fly_no')
                ->orderBy('flight_info.fly_date')
                ->orderBy('flight_info.dep_time')
                ->paginate(10);
                // ->get();

            // Log::debug($data);

            return view('admin')
                ->with('today', $this->today)
                ->with('airLine', $this->airLine)
                ->with('airPlane', $this->airPlanes)
                ->with('port', $this->port)
                ->with('data', $data);

        } catch (Exception $e) {
            Log::debug($e);
        }
    }

    // ---------------------------------
    // 메소드명	: delete()
    // 기능		: 운항정보를 삭제
    // 파라미터	: Request    $req
    // 리턴값	: JSON       bool,string
    // ---------------------------------
    public function delete(Request $req) {
        Log::debug($req);
        try {
            DB::beginTransaction();

            // fly_no로 운항정보를 찾음
            $data = FlightInfo::find($req->fly_no);

            if (!$data) {
                return response()
                    ->json([
                        'success' => false
                        ,'message' => '존재하지 않는 데이터입니다.'
                    ]);
            }

            // 삭제일을 오늘로 설정
            $data->deleted_at = Carbon::now();
            // 삭제사유를 관리자가 입력한 사유로 설정
            $data->del_reason = $req->del_reason;
            $data->save();

            // 메일발송을 위해 select
            $userList = FlightInfo::where('flight_info.fly_no', $data->fly_no)
                ->join('reserve_info AS res', 'flight_info.fly_no', 'res.fly_no')
                ->join('ticket_info AS tic', 'res.reserve_no', 'tic.reserve_no')
                ->join('user_info AS user', 'res.u_no', 'user.u_no')
                ->join('airport_info AS dep', 'flight_info.dep_port_no', 'dep.port_no')
                ->join('airport_info AS arr', 'flight_info.arr_port_no', 'arr.port_no')
                ->join('airplane_info AS airp', 'flight_info.plane_no', 'airp.plane_no')
                ->join('airline_info AS airl', 'airp.line_no', 'airl.line_no')
                ->withTrashed()
                ->select(
                    'user.u_name'
                    ,'user.u_email'
                    ,'airl.line_name'
                    ,'flight_info.dep_time'
                    ,'flight_info.arr_time'
                    ,'flight_info.fly_date'
                    ,'dep.port_name AS dep_port_name'
                    ,'arr.port_name AS arr_port_name'
                )
                ->get();

            // 환불처리를 위해 select
            $payList = Payment::join('reserve_info AS res', 'res.reserve_no', 'payment.reserve_no')
                    ->join('flight_info AS fli', 'res.fly_no', 'fli.fly_no')
                    ->where('fli.fly_no', $data->fly_no)
                    ->select(
                        'merchant_uid'
                        ,'res.reserve_no'
                    )
                    ->get();

            // 환불처리를 위해 토큰을 받음
            $accessToken = getToken();
            // Log::debug('환불할 유저 : ', [$payList]);
            // Log::debug('토큰 : ', [$accessToken]);

            // 환불처리 및 DB삭제처리
            foreach ($payList as $val) {
                $result = Http::withHeaders([
                    'Content-Type'  => 'application/json',
                    'Authorization' => $accessToken
                ])->post("https://api.iamport.kr/payments/cancel", [
                    'merchant_uid'  => $val->merchant_uid
                    ,'reason'       => '결항으로 인한 환불'
                ]);

                Log::debug('pay foreach : ', [$result]);

                ReserveInfo::where('reserve_no', $req->reserve_no)->delete();
                TicketInfo::where('reserve_no', $req->reserve_no)->delete();
                Payment::where('merchant_uid', $req->merchant_uid)->delete();
            }

            // foreach ($userList as $user) {
            //     // Log::debug($user);
            //     Mail::to($user->u_email)->send(new ResCancel($user, $data->del_reason));
            // }
            foreach ($userList as $user) {
                // 큐에 작업 추가
                SendEmailCancel::dispatch($user, $data->del_reason);
            }

            DB::commit();
            return response()
                ->json([
                    'success'   => true
                    ,'message'  => '결항처리 되었습니다.'
                ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::debug($e);

            return response()
                ->json([
                    'success'   => false
                    ,'message'  => '서버 에러'
                ]);
        }
    }

    // ---------------------------------
    // 메소드명	: store()
    // 기능		: 운항정보를 추가
    // 파라미터	: Request    $req
    // 리턴값	: 
    // ---------------------------------
    public function store(Request $req) {
        // Log::debug($req);
        try {
            DB::beginTransaction();
            
            // 가격에서 ","를 제외
            $price = str_replace(',', '', $req->price);
            // Log::debug('price : ', [$price]);

            // 시 : 분으로 입력받은 데이터를 합침
            $depTime = $req->depHour . $req->depMin;
            $arrTime = $req->arrHour . $req->arrMin;

            $flightData = new FlightInfo([
                'fly_date'      => $req->flightDate
                ,'price'        => $price
                ,'dep_port_no'  => $req->depPort
                ,'arr_port_no'  => $req->arrPort
                ,'plane_no'     => $req->airPlane
                ,'flight_num'   => $req->flightNum
                ,'dep_time'     => $depTime
                ,'arr_time'     => $arrTime
            ]);

            $flightData->save();
            Log::debug($flightData);

            DB::commit();

            return redirect()->route('admin.index')->with('alert', '등록되었습니다');
        } catch (Exception $e) {
            DB::rollBack();
            Log::debug($e);
            return redirect()->route('admin.index')->with('alert', '서버 에러');
        }
    }

    // ---------------------------------
    // 메소드명	: update()
    // 기능		: 지연 사유 및 지연시간을 추가
    // 파라미터	: Request    $req
    // 리턴값	: 
    // ---------------------------------
    public function update(Request $req) {
        try {
            DB::beginTransaction();

            // 운항정보를 찾음
            $flight = FlightInfo::find($req->fly_no);

            if (!$flight) {
                return redirect()->back()->with('alert', '해당 항공편을 찾을 수 없습니다.');
            }

            // 기존에 저장된 JSON 데이터를 가져오거나, null이라면 빈 배열로 초기화
            $delayData = json_decode($flight->delay_reasons) ?? [];

            // 오늘날짜를 가져와서 문자열로 변환
            $today = strval(Carbon::now());
            // Log::debug($delayData);

            // 새로운 지연 정보 추가
            $delayData[] = [
                $today => $req->delayReason
            ];

            $flight->update([
                'delay_reasons' => $delayData
                ,'fly_date'     => $req->flyDate
                ,'dep_time'     => $req->depHour . $req->depMin
                ,'arr_time'     => $req->arrHour . $req->arrMin
            ]);

            // 메일발송을 위해 select
            $userList = FlightInfo::where('flight_info.fly_no', $flight->fly_no)
                ->join('reserve_info AS res', 'flight_info.fly_no', 'res.fly_no')
                ->join('user_info AS user', 'res.u_no', 'user.u_no')
                ->join('airport_info AS dep', 'flight_info.dep_port_no', 'dep.port_no')
                ->join('airport_info AS arr', 'flight_info.arr_port_no', 'arr.port_no')
                ->join('airplane_info AS airp', 'flight_info.plane_no', 'airp.plane_no')
                ->join('airline_info AS airl', 'airp.line_no', 'airl.line_no')
                ->withTrashed()
                ->select(
                    'user.u_name'
                    ,'user.u_email'
                    ,'airl.line_name'
                    ,'flight_info.dep_time'
                    ,'flight_info.arr_time'
                    ,'flight_info.fly_date'
                    ,'dep.port_name AS dep_port_name'
                    ,'arr.port_name AS arr_port_name'
                )
                ->get();

            // Log::debug('컨트롤러 : ', [$userList]);
            
            // 지연 알림 메일발송(큐에 작업 추가)
            foreach ($userList as $user) {
                $userDataArray = [
                    'u_name'         => $user->u_name
                    ,'u_email'       => $user->u_email
                    ,'line_name'     => $user->line_name
                    ,'dep_time'      => $user->dep_time
                    ,'arr_time'      => $user->arr_time
                    ,'fly_date'      => $user->fly_date
                    ,'dep_port_name' => $user->dep_port_name
                    ,'arr_port_name' => $user->arr_port_name
                ];
                Mail::to($user->u_email)->queue(new SendEmailDelay($userDataArray, $req->delayReason));
            }

            DB::commit();

            return redirect()->back()->with('alert', '지연 정보가 업데이트 되었습니다.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::debug($e);
            return redirect()->back()->with('alert', '업데이트중 에러가 발생하였습니다.');
        }
    }
}
