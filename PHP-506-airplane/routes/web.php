<?php
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : routes
 * 파일명       : web.php
 * 이력         :   v001 0612 박수연 new
 *                  v002 0612 이동호 add 공지사항 리스트
**************************************************/

use App\Http\Controllers\NoticeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
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

Route::get('/', [ReservationController::class, 'main'])->name('reservation.main');

// 0612 유저 (수연)
Route::get('/users/login', [UserController::class, 'login'])->name('users.login');
Route::post('/users/loginpost', [UserController::class, 'loginpost'])->name('users.login.post');
Route::get('/users/registration', [UserController::class, 'registration'])->name('users.registration');
Route::post('/users/registrationpost', [UserController::class, 'registrationpost'])->name('users.registration.post');
Route::get('/users/logout', [UserController::class, 'logout'])->name('users.logout');
Route::get('/users/withdraw', [UserController::class, 'withdraw'])->name('users.withdraw');
Route::get('/users/useredit', [UserController::class, 'useredit'])->name('users.useredit');
Route::post('/users/usereditpost', [UserController::class, 'usereditpost'])->name('users.useredit.post');

// 0612 이메일 (수연) 
// 이메일 전송
Route::get('/users/email', [MailController::class, 'email'])->name('emails.email');
Route::post('/users/emailpost', [MailController::class, 'emailpost'])->name('emails.email.post');

// 이메일 인증
Route::get('/users/emailverify/{code}', [UserController::class, 'emailverify'])->name('emailverifys.emailverify');

// 이메일 재인증
Route::get('/users/emailverify_resend', [UserController::class, 'emailverify_resend'])->name('emailverifys_resend.emailverify_resend');

// 이메일 찾기
Route::get('/users/findemail', [UserController::class, 'findemail'])->name('findemails.findemail');
Route::post('/users/findemailpost', [UserController::class, 'findemail'])->name('findemails.findemail.post');

// 이메일 찾기 답변
Route::post('/users/emailanswer', [UserController::class, 'emailanswer'])->name('emailanswers.emailanswer');

// 비밀번호 찾기
Route::get('/users/findpassword', [UserController::class, 'findpassword'])->name('findpasswords.findpassword');
Route::post('/users/findpasswordpost', [UserController::class, 'findpasswordpost'])->name('findpasswords.findpassword.post');

// 비밀번호 변경
Route::get('/users/changepassword', [UserController::class, 'changepassword'])->name('changepasswords.changepassword');
Route::post('/users/changepasswordpost', [UserController::class, 'changepassword'])->name('changepasswords.changepassword.post');

// v002 add 이동호
// 메인페이지
Route::get('/reservation/main', [ReservationController::class, 'main'])->name('reservation.main');
// 공지사항
Route::resource('/notice', NoticeController::class);

// 0613 add 오재훈
// 예약 조회(항공편 선택) 페이지
Route::get('/reservation/check', [ReservationController::class, 'check'])->name('reservation.check');