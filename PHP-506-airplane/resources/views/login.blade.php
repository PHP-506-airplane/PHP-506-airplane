{{-- 
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views
 * 파일명       : login.blade.php
 * 이력         :   v001 0612 박수연 new
**************************************************/
--}}

@extends('layout.layout')

@section('title', 'Login')

@section('css') 
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection

@section('contents')

<form action="{{route('users.login.post')}}" method="post">
    @csrf
    <div class="wrap">
            <div class="login">
                <h2>로그인</h2>
                {{-- @include('errors.errorsvalidate') --}}
                <div class="login_id">
                    <label for="u_email">이메일 </label>
                    <input type="email" name="u_email" id="u_email" placeholder="Email">
                </div>
                <div class="login_pw">
                    <label for="u_pw">비밀번호 </label>
                    <input type="password" name="u_pw" id="u_pw" placeholder="Password">
                </div>
                <div class="login_etc">
                    <div class="space">
                    </div>
                    <div class="forgot_pw">
                    <a href="{{route('users.registration')}}">회원가입</a>
                    </div>
                </div>
                <div class="submit">
                    <input type="submit" value="로그인">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection


 
{{-- ----------------------------------------------------------------------------------------------------------------
로그인 페이지 버튼 주석
<button type="submit">Login</button>
<button class="bnt" type="button" onclick="location.href = '{{route('findemails.findemail')}}'">이메일 찾기</button>
<button class="bnt" type="button" onclick="location.href = '{{route('findpasswords.findpassword')}}'">비밀번호 찾기</button>
<button class="bnt" type="button" onclick="location.href = '{{route('users.registration')}}'">회원가입</button> 
---}}