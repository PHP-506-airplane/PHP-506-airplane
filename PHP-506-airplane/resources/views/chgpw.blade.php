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
        <label for="password">비밀번호 : </label>
        <input type="text" name="password" oninput="chkPw()" id="password">
        <br>
        <label for="passwordchk">비밀번호 확인 : </label>
        <input type="text" name="passwordchk" oninput="chkPw()" id="passwordchk">
        <div id="chk_pw_msg"></div>
        <br>
        <button type="submit" onclick="location.href = '{{route('users.chgpw.post')}}'">변경</button>
        <button type="button" onclick="location.href = '{{route('reservation.main')}}'">취소</button>
    </form>

@endsection

@section('js')
    <script src="{{asset('js/registration.js')}}"></script>
@endsection