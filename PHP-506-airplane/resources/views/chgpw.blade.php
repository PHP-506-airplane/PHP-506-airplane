{{-- 
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views
 * 파일명       : chgpw.blade.php
 * 이력         :   v001 0613 박수연 new
**************************************************/
--}}

@extends('layout.layout')

@section('title', '비밀번호 확인')

@section('contents')
    <form action="{{route('users.chgpw.post')}}" method="post">
        <h1>비밀번호 수정</h1>
        @csrf
        @method('put')
         <p id="passwordStatus"></p>
        <label for="nowpassword">현재 비밀번호 : </label>
        <input type="text" name="nowpassword" id="nowpassword">
        <br>
        <label for="password">비밀번호 : </label>
        <input type="text" name="password" oninput="chkPw()" id="password">
        <br>
        <label for="pwchk">비밀번호 확인 : </label>
        <input type="text" name="pwchk" oninput="chkPw()" id="pwchk">
        <div id="chk_pw_msg"></div>
        <br>
        <button type="submit" onclick="location.href = '{{route('users.chgpw.post')}}'">변경</button>
        <button type="button" onclick="location.href = '{{route('reservation.main')}}'">취소</button>
    </form>
@endsection

@section('js')
    <script src="{{asset('js/chkpw.js')}}"></script>
@endsection