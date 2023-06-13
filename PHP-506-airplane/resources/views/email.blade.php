{{-- 
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views
 * 파일명       : email.blade.php
 * 이력         :   v001 0613 박수연 new
**************************************************/
--}}
@extends('layout.layout')

@section('title', 'Email')

@section('contents')
    <h1>이메일 인증</h1>
    {{-- @include('layout.errorsvalidate') --}}

    <form action="{{route('emailverifys.emailverify')}}" method="post">
        @csrf
        <label for="email">Email : </label>
        <input type="text" name="email" id="email">

        <button type="submit">이메일 받기</button>
    </form>

@endsection