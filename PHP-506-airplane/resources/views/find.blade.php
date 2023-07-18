{{-- 
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views
 * 파일명       : find.blade.php
 * 이력         :   v001 0718 이동호 new
**************************************************/
--}}
@extends('layout.layout')

@section('title', '이메일/비밀번호 찾기')

@section('css') 
    <link rel="stylesheet" href="{{asset('css/find.css')}}">
@endsection

@section('contents')
    {{-- @if($type === 'id')
        아이디 찾기
    @elseif($type === 'pw')
        비밀번호 찾기
    @else
        에러임
    @endif --}}
<div class="con">
    <div>
        <span>아이디 찾기</span>
    </div>
    <h3>아이디 찾기</h3>
</div>
@endsection

@section('js')
    <script src="{{asset('js/find.js')}}"></script>
@endsection

