{{-- 
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views
 * 파일명       : findpassword.blade.php
 * 이력         :   v001 0613 박수연 new
**************************************************/
--}}

@extends('layout.layout')

@section('title', '비밀번호 찾기')

@section('contents')
    <h1>비밀번호 찾기</h1>
    <br>
    <form action="{{route('users.login.post')}}" method="post">
        @csrf
        <label for="name">Name : </label>
        <input type="text" name="name" id="name">
        <br>
        <label for="email">Email : </label>
        <input type="text" name="email" id="email">
        <br>
        <br>
        <button type="submit" onclick="location.href = '{{route('emails.email')}}'">이메일 발송</button>
        <button type="button" onclick="location.href = '{{route('users.login')}}'">취소</button>
    </form>

@endsection

