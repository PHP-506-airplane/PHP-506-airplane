<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AdminPageMiddleware;
use App\Models\AirLineInfo;
use App\Models\FlightInfo;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    // 미들웨어로 관리자권한 체크
    public function __construct() {
        $this->middleware(AdminPageMiddleware::class)->only(['index']);
    }

    public function index() {
        $airLine = AirLineInfo::get();
        $today = Carbon::now()->toDateString();
        return view('admin')
            ->with('airLine', $airLine)
            ->with('today', $today);
    }

    public function search(Request $req) {
        Log::debug($req);
        try {
            $dateStart = $req->dateStart;
            $dateEnd = $req->dateEnd;
            $airline = $req->airline;
    
            // 날짜 범위 + 항공사를 기준으로 운항 정보 검색
            $query = FlightInfo::query();
            $query->whereBetween('fly_date', [$dateStart, $dateEnd]);
    
            if ($airline != 0) {
                $query->where('line_no', $airline);
            }
    
            $data = $query->get();

            return response()
                ->json([
                    'success'   => true
                    ,'data'     => $data
                ]);
        } catch (Exception $e) {
            return response()
                ->json([
                    'success'   => false
                    ,'error'    => $e
                ]);
        }
    }
}
