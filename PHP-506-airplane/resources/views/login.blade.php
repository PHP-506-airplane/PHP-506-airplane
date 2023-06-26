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

    {{-- <div class="wrap">
            <div class="login">
                <h2>로그인</h2>
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
</form> --}}
<div id="con">
    <div id="login">
        <div id="login_form"><!--로그인 폼-->
        <form action="{{route('users.login.post')}}" method="post">
        @csrf 
            <h3 class="login" style="letter-spacing:-1px;">로그인</h3>
            <hr>
            <label>
            <p style="text-align: left; font-size:12px; color:#666">이메일</p>
            <input type="text" placeholder="아이디를 입력하세요" class="size" name="u_email" id="u_email">
            <p></p>
            </label>
            <br>
            <label>
            <p style="text-align: left; font-size:12px; color:#666">비밀번호</p>
            <input type="text" placeholder="비밀번호를 입력하세요" class="size" name="u_pw" id="u_pw">
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
        
        </div>
    <div>
</div>


@endsection

