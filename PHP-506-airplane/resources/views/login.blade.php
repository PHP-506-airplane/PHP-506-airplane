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

@section('contents')
    @include('errors.errorsvalidate')
    <h1>로그인</h1>
    <form action="{{route('users.login.post')}}" method="post">
        @csrf
        <label for="u_email">Email : </label>
        <input type="text" name="u_email" id="email" required>

        <label for="u_pw">password : </label>
        <input type="password" name="u_pw" id="password" required>
        <br>
        <button type="submit">Login</button>
        <button type="button" onclick="location.href = '{{route('findemails.findemail')}}'">이메일 찾기</button>
        <button type="button" onclick="location.href = '{{route('findpasswords.findpassword')}}'">비밀번호 찾기</button>
        <button type="button" onclick="location.href = '{{route('users.registration')}}'">회원가입</button>
    </form>

@endsection