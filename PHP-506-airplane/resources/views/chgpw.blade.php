{{-- 
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views
 * 파일명       : chgpw.blade.php
 * 이력         :   v001 0613 박수연 new
**************************************************/
--}}

@extends('layout.layout')

@section('title', '비밀번호 수정')

@section('css') 
    <link rel="stylesheet" href="{{asset('css/chgpw.css')}}">
@endsection

@section('contents')
    <div id="con">
    <div id="login">
        <div id="login_form">
        <form action="{{route('users.chgpw.post')}}" method="post">
        @csrf 
        @method('put')
            <h3 class="login" style="letter-spacing:-1px;">비밀번호 변경</h3>
            <hr>
            <label>
            <p style="text-align: left; font-size:12px; color:#666">현재 비밀번호</p>
            <input type="password" placeholder="현재 비밀번호를 입력하세요" class="size" name="nowpassword" id="nowpassword">
            <p></p>
            </label>
            <br>
            <label>
            <p style="text-align: left; font-size:12px; color:#666">비밀번호</p>
            <input type="password" placeholder="비밀번호를 입력하세요" class="size" name="password" id="password" oninput="chkPw()">
            <div class="space1"></div>
            </label>
            <br>
            <p style="text-align: left; font-size:12px; color:#666">비밀번호 확인</p>
            <input type="password" placeholder="비밀번호 확인을 입력하세요" class="size" name="passwordchk" id="pwchk" oninput="chkPw()">
            <div id="chk_pw_msg"></div>
            </label>
            <div style="height:30px"></div>
            <p>
                <input type="submit" value="변경" class="btn">
            </p>
        </form>
        <hr>
        <p class="find">
            <span><a href="{{route('users.registration')}}">회원가입</a></span>
            <span><a href="{{route('reservation.main')}}">취소</a></span>
        </p>
        </div>
</div>

@endsection

@section('js')
    <script src="{{asset('js/chkpw.js')}}"></script>
@endsection