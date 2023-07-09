<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// // 결제 --------------------------------
// Route::get('users/getCurrentUser', [UserController::class, 'getCurrentUser']);
// Route::get('pay/getMerchantUidAndSetPrice', [PayController::class, 'getMerchantUidAndSetPrice']);
// Route::post('pay/complete', [PayController::class, 'complete']);
// Route::post('pay/removePayAuth', [PayController::class, 'removePayAuth']);
// // 결제 --------------------------------