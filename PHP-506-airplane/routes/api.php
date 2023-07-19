<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// 이메일 중복
Route::post('/mail', [ApiController::class, 'chkEmail']);

// 0716 이동호
// 결제
// 좌석 중복 확인
Route::get('/reservations/duplicate-check/{fly_no}/{seat_no}', [ReservationController::class, 'dupChk']);
// 가격 가져오기
Route::get('/pay/price/{pk}', [PayController::class, 'price']);
// 중복예약 방지 캐싱
Route::post('/reservations/cache', [ReservationController::class, 'caching']);
// 캐시 지우기
Route::post('/reservations/clearCache', [ReservationController::class, 'clearCache']);
// 이메일 찾기
Route::post('/users/email', [UserController::class, 'findEmail']);
// 비밀번호 찾기
Route::post('/users/password', [UserController::class, 'findPw']);

