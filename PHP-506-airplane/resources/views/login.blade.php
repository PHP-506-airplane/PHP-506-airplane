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
<div id="con">
    <div id="login">
        <div id="login_form">
            <form action="{{route('users.login.post')}}" method="post">
            @csrf 
                <h3 class="login" style="letter-spacing:-1px;">로그인</h3>
                <hr>
                <label class="loginlabel">
                    <p style="text-align: left; font-size:12px; color:#666">이메일</p>
                    <input type="text" placeholder="아이디를 입력하세요" class="size" name="u_email" id="u_email">
                    <p></p>
                </label>
                <br>
                <label class="loginlabel">
                    <p style="text-align: left; font-size:12px; color:#666">비밀번호</p>
                    <input type="password" placeholder="비밀번호를 입력하세요" class="size" name="u_pw" id="u_pw">
                </label>
                <div style="height:30px"></div>
                <p>
                    <input type="submit" value="로그인" class="btn">
                </p>
            </form>
        <hr>
        <p class="find">
            <span><a href="{{route('users.registration')}}">회원가입</a></span>
        </p>
        <a href="{{ url('/login/kakao') }}" class="btn btn-primary btn-kakao">
            <i><img src="{{asset('img/kakao-icon.svg')}}" alt="" style="width: 24px;height:24px;"></i>&nbsp;카카오로 로그인
        </a><br><br>
        <a href="{{ url('/login/naver') }}" class="btn btn-primary btn-naver">
            <i><img src="{{asset('img/naver-icon.svg')}}" alt="" style="width: 20px;height:20px;"></i>&nbsp;네이버로 로그인
        </a><br><br>
        <a href="{{ url('/login/google') }}" class="btn btn-primary btn-google">
            <i><img src="{{asset('img/google-icon.svg')}}" alt="" style="width: 24px;height:24px;"></i>&nbsp;구글로 로그인
        </a>
    </div>
</div>


@endsection

