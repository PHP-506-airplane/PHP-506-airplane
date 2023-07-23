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
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected $today;
    protected $airLine;
    protected $airPlanes;
    protected $port;

    // ---------------------------------
    // 메소드명	: __construct()
    // 기능		: 공통 데이터를 생성
    // 파라미터	: 없음
    // 리턴값	: 없음
    // ---------------------------------
    public function __construct() {
        // 미들웨어로 관리자권한 체크
        $this->middleware(AdminPageMiddleware::class);
        $this->today = Carbon::now()->toDateString();
        $this->airLine = AirLineInfo::get();
        $this->airPlanes = AirplaneInfo::join('airline_info AS airl', 'airplane_info.line_no', 'airl.line_no')
            ->get();
        $this->port = AirportInfo::get();
    }

    // ---------------------------------
    // 메소드명	: index()
    // 기능		: 리스트 페이지로 리다이렉트
    // 파라미터	: 없음
    // 리턴값	: 
    // ---------------------------------
    public function index() {
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

    public function search(Request $req) {
        // Log::debug($req);
        try {
            $dateStart = $req->dateStart;
            $dateEnd = $req->dateEnd;
            $airline = $req->airline;
            $depPort = $req->depPort;
            $arrPort = $req->arrPort;
            $state = $req->state;
    
            // 운항 정보 검색
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
                )
                ->whereBetween('fly_date', [$dateStart, $dateEnd]);

            if ($airline !== '0') {
                $data->where('line.line_no', $airline);
            }

            if ($depPort !== '0') {
                $data->where('dep_port_no', $depPort);
            }

            if ($arrPort !== '0') {
                $data->where('arr_port_no', $arrPort);
            }

            if ($state === '1') {
                $data->whereNull('deleted_at');
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

            $data = FlightInfo::find($req->fly_no);

            if (!$data) {
                return response()
                    ->json([
                        'success' => false
                        ,'message' => '존재하지 않는 데이터입니다.'
                    ]);
            }

            $data->deleted_at = Carbon::now();
            $data->del_reason = $req->del_reason;
            $data->save();

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
                    'success' => true
                    ,'message' => '결항되었습니다.'
                ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::debug($e);

            return response()
                ->json([
                    'success' => false
                    ,'message' => '서버 에러'
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
        Log::debug($req);
        try {
            DB::beginTransaction();
            
            $price = str_replace(',', '', $req->price);
            Log::debug('price : ', [$price]);

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

            $flight = FlightInfo::find($req->fly_no);

            if (!$flight) {
                return redirect()->back()->with('alert', '해당 항공편을 찾을 수 없습니다.');
            }

            // 기존에 저장된 JSON 데이터를 가져오거나, null이라면 빈 배열로 초기화
            $delayData = json_decode($flight->delay_reasons) ?? [];
            $today = strval(Carbon::now());
            Log::debug($delayData);
        
            // 새로운 지연 정보 추가
            $delayData[] = [
                $today => $req->delayReason
            ];
        
            $flight->update([
                'delay_reasons' => $delayData
                ,'dep_time' => $req->depHour . $req->depMin
                ,'arr_time' => $req->arrHour . $req->arrMin
            ]);

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
            
            Log::debug('컨트롤러 : ', [$userList]);
            
            foreach ($userList as $user) {
                $userDataArray = [
                    'u_name' => $user->u_name,
                    'u_email' => $user->u_email,
                    'line_name' => $user->line_name,
                    'dep_time' => $user->dep_time,
                    'arr_time' => $user->arr_time,
                    'fly_date' => $user->fly_date,
                    'dep_port_name' => $user->dep_port_name,
                    'arr_port_name' => $user->arr_port_name,
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
