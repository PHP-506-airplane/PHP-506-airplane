{{-- 
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views
 * 파일명       : sendemail.blade.php
 * 이력         :   v001 0613 박수연 new
**************************************************/
--}}
@extends('layout.layout')

@section('title', 'Email')

@section('contents')
    <h1>이메일 인증</h1>

    <div>{{$name}}, 이메일 인증을 하세요.</div>
    
    <div><a href="{{ route('emailverifys.emailverify', ['code' => $verification_code]) }}">이메일 인증 링크</a></div>

@endsection