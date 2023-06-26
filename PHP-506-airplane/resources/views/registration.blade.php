{{-- 
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views
 * 파일명       : registration.blade.php
 * 이력         :   v001 0612 박수연 new
**************************************************/
--}}

@extends('layout.layout')

@section('title', 'Registration')

@section('css') 
    <link rel="stylesheet" href="{{asset('css/registration.css')}}">
@endsection

@section('contents')

<div id="con">
<div id="login">
<div id="login_form"><!--로그인 폼-->
<form action="{{route('users.registration.post')}}" method="post">
    @csrf
    <h3 class="login" style="letter-spacing:-1px;">회원가입</h3>
    <hr>
    <p style="text-align: left; font-size:12px; color:#666; margin-top:1rem">이름</p>
    <input type="text" placeholder="이름" class="size" name="name" id="name" autocomplete="off">
    </label>
    <br>
    <label>
        <p style="text-align: left; font-size:12px; color:#666; margin-top:1rem">이메일</p>
        <input type="text" placeholder="이메일" class="size" name="email" id="email" autocomplete="off">
        <br>
        <button type="button" id="errMsgemail" onclick="chkEmail()">이메일 중복 확인</button>
    </label> 
    <br>
    <label>
    <p style="text-align: left; font-size:12px; color:#666l margin-top:1rem">비밀번호</p>
    <input type="password" placeholder="비밀번호" class="size" oninput="chkPw()" name="password" id="password">
    </label>
    <br>
    <label>
        <p style="text-align: left; font-size:12px; color:#666; margin-top:1rem">비밀번호 확인</p>
        <input type="password" placeholder="비밀번호 확인" class="size" oninput="chkPw()" name="passwordchk" id="pwchk">
        <div id="chk_pw_msg"></div> 
    </label>
    <br>
    <label>
        <p style="text-align: left; font-size:12px; color:#666; margin-top:1rem">생년월일</p>
        <input type="date" placeholder="생년월일" class="size" name="birth" id="u_birth">
    </label>
    <br>
    <label>
        <p style="text-align: left; font-size:12px; color:#666; margin-top:1rem">성별</p>
        <input type="radio" placeholder="성별" class="size" name="gender" id="u_gender" value="M">남
        <input type="radio" placeholder="성별" class="size" name="gender" id="u_gender" value="F">여
    </label>
    <br>
    {{-- <label>
        <p style="text-align: left; font-size:12px; color:#666">비밀번호 찾기 질문</p>
        <select class="size num1" name="myselect">
            <option value="1">기억에 남는 추억의 장소는?</option>
            <option value="2">나의 보물 제1호는?</option>
            <option value="3">가장 기억에 남는 영화는?</option>
            <option value="4">우리집 애완동물의 이름은?</option>
        </select>
        <input type="text" placeholder="힌트" class="size" name="answer" id="answer">
    </label> --}}
            <div style="height:20px"></div>
            <br>
                <p>
                    <input type="submit" value="회원가입" class="btn">
                </p>
            </form>
            <hr>
            <p class="find">
                <span><a href="{{route('users.login')}}" >로그인 페이지로 이동</a></span>
            </p>
        </div>
    <div>
</div>
@endsection


@section('js')
    <script src="{{asset('js/chkPw.js')}}"></script>
    <script src="{{asset('js/checkemail.js')}}"></script>
@endsection