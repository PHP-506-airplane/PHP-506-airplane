<?php
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : routes
 * 파일명       : web.php
 * 이력         :   v001 0612 박수연 new
 *                  v002 0612 이동호 add 공지사항 리스트
**************************************************/

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PayController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ReservationController::class, 'main']);

// 0612 유저
Route::get('/users/login', [UserController::class, 'login'])->name('users.login');
Route::post('/users/loginpost', [UserController::class, 'loginpost'])->name('users.login.post');
Route::get('/users/registration', [UserController::class, 'registration'])->name('users.registration');
Route::post('/users/registrationpost', [UserController::class, 'registrationpost'])->name('users.registration.post');
Route::get('/users/logout', [UserController::class, 'logout'])->name('users.logout');
Route::get('/users/logoutPw', [UserController::class, 'logoutPw'])->name('users.logoutPw');
Route::get('/users/withdraw', [UserController::class, 'withdraw'])->name('users.withdraw');
Route::get('/users/useredit', [UserController::class, 'useredit'])->name('users.useredit');
Route::put('/users/usereditpost', [UserController::class, 'usereditpost'])->name('users.useredit.post');

// 비밀번호 변경
Route::get('/users/chgpw', [UserController::class, 'chgpw'])->name('users.chgpw');
Route::put('/users/chgpwpost', [UserController::class, 'chgpwpost'])->name('users.chgpw.post');

// v002 add 이동호
// 메인페이지
Route::get('/reservation/main', [ReservationController::class, 'main'])->name('reservation.main');
// 공지사항
Route::get('/notice/baggage', [NoticeController::class, 'baggage'])->name('notice.baggage');
// Route::get('/notice/rate', [NoticeController::class, 'rateinfoget'])->name('notice.rateinfoget');
Route::resource('/notice', NoticeController::class);
// 나의 예약 조회 페이지
Route::get('/reservation/myreservation', [ReservationController::class, 'myreservation'])->name('reservation.myreservation');
// 예약 취소
Route::post('/reservation/myreservation', [ReservationController::class, 'rescancle'])->name('reservation.rescancle');
// 메일 인증(가입 시)
Route::get('/users/verify/{code}', [UserController::class, 'verify'])->name('users.verify');
// 메일 재전송(가입 시)
Route::get('/resend-email', [UserController::class, 'resendemail'])->name('user.resendemail');
// 아이디 / 비밀번호 찾기 페이지
Route::get('/users/find/{type}', [UserController::class, 'find'])->name('users.find');
// 관리자 페이지
Route::get('/admin/list', [AdminController::class, 'index'])->name('admin.index');



// 0613 add 오재훈
// 예약 조회(항공편 선택) 페이지
Route::get('/reservation/check', [ReservationController::class, 'check'])->name('reservation.check');
Route::post('/reservation/checkpost', [ReservationController::class, 'checkpost'])->name('reservation.checkpost');
Route::post('/reservation/seatpost', [ReservationController::class, 'seatpost'])->name('reservation.seatpost');

// social 로그인
Route::get('/login/{provider}', [UserController::class, 'redirect']);
Route::get('/login/{provider}/callback', [UserController::class, 'Callback']);
Route::get('/users/mypage', [UserController::class, 'mypage'])->name('users.mypage');

//좌석 선택 후 상세정보 입력 페이지
Route::get('/reservation/reserveInsert',[ReservationController::class,'reserveInsert'])->name('reservation.reserveInsert');

