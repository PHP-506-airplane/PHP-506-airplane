<?php

use App\Http\Controllers\NoticeController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

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

// 0612 add 이동호
Route::get('/notice/list', [NoticeController::class, 'index'])->name('notice.index');
