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

    {{-- @include('errors.errorsvalidate')
    <div><span class="loginspan">로그인</span></div>
<div class="con">
    <form action="{{route('users.login.post')}}" method="post">
            @csrf
        <div class="input-box">
            <label for="u_email">Email : </label>
            <input type="text" name="u_email" id="email" placeholder="email" required>
        </div>
        <div class="input-box">
            <label for="u_pw">password : </label>
            <input type="password" name="u_pw" id="password" placeholder="password" required>
        </div>
            <input type="submit" value="Login" class="btn">
            <br>
            <span id="forgot"><a href="{{route('findpasswords.findpassword')}}">비밀번호 찾기</span>
            <span class="stick">|</span>
            <span><a href="{{route('findemails.findemail')}}">이메일 찾기</span>
            <span class="stick">|</span>
            <span><a href="{{route('users.registration')}}">회원가입</span> --}}

            
            {{-- ----------------------------------------------------------------------------------------------------------------
            로그인 페이지 버튼 주석
            <button type="submit">Login</button>
            <button class="bnt" type="button" onclick="location.href = '{{route('findemails.findemail')}}'">이메일 찾기</button>
            <button class="bnt" type="button" onclick="location.href = '{{route('findpasswords.findpassword')}}'">비밀번호 찾기</button>
            <button class="bnt" type="button" onclick="location.href = '{{route('users.registration')}}'">회원가입</button> 
            -----------------------------------------------------------------------------------------------------------------------}}


<form action="{{route('users.login.post')}}" method="post">
    @csrf
    <div class="wrap">
            <div class="login">
                <h2>Log-in</h2>
            {{-- <div class="login_sns">
            <li><a href=""><i class="fab fa-instagram"></i></a></li>
            <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
            <li><a href=""><i class="fab fa-twitter"></i></a></li>
            </div> --}}
                <div class="login_id">
                    {{-- <h4>이메일</h4> --}}
                    <label for="u_email">Email : </label>
                    <input type="email" name="u_email" id="u_email" placeholder="Email">
                </div>
                <div class="login_pw">
                    <label for="u_pw">Password : </label>
                    {{-- <h4>비밀번호</h4> --}}
                    <input type="password" name="u_pw" id="u_pw" placeholder="Password">
                </div>
                <div class="login_etc">
                    <div class="checkbox">
                    <input type="checkbox" name="" id=""> Remember Me?
                    </div>
                    <div class="forgot_pw">
                    <a href="{{route('findpasswords.findpassword')}}">비밀번호 찾기</a>
                    </div>
                    <span class="stick">|</span>
                    <div class="forgot_pw">
                    <a href="{{route('findemails.findemail')}}">이메일 찾기</a>
                    </div>
                    <span class="stick">|</span>
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
