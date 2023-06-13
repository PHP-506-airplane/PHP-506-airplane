{{-- 
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views
 * 파일명       : chkpassword.blade.php
 * 이력         :   v001 0613 박수연 new
**************************************************/
--}}

@extends('layout.layout')

@section('title', '비밀번호 확인')

@section('contents')
    <h1>비밀번호 확인</h1>
    <br>
    <form action="{{route('users.login.post')}}" method="post">
        @csrf
        @method('put')
        <label for="password">비밀번호 : </label>
        <input type="text" name="password" id="password">
        <br>
        <label for="passwordchk">비밀번호 확인 : </label>
        <input type="text" name="passwordchk" id="passwordchk">
        <br>
        <br>
        <button type="submit" onclick="location.href = '{{route('users.edit')}}'">변경</button>
        <button type="button" onclick="location.href = '{{route('reservation.main')}}'">취소</button>
    </form>

@endsection

