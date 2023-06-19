{{-- 
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views
 * 파일명       : findemail.blade.php
 * 이력         :   v001 0613 박수연 new
**************************************************/
--}}
@extends('layout.layout')

@section('title', '이메일 찾기')

@section('css') 
    <link rel="stylesheet" href="{{asset('css/findemail.css')}}">
@endsection

@section('contents')
    {{-- <h1>이메일 찾기</h1>
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
        <button type="submit">이메일 발송</button>
        <button type="button" onclick="location.href = '{{route('users.login')}}'">취소</button>
    </form> --}}
    <form action="{{route('users.login.post')}}" method="post">
    @csrf
    <div class="wrap">
            <div class="login">
                <h2>이메일 찾기</h2>
                <div class="login_id">
                    <label for="u_name">이름 : </label>
                    <input type="text" name="u_name" id="u_name" placeholder="">
                </div>
                <div class="login_pw">
                    <label for="u_pw">비밀번호 : </label>
                    <input type="password" name="u_pw" id="u_pw" placeholder="">
                </div>
                <div class="submit">
                    <input type="submit" value="이메일 발송">
                </div>
                <div class="submit2">
                    <input type="button" value="취소" onclick="location.href = '{{route('users.login')}}'">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

