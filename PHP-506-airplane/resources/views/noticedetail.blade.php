{{-- 
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views
 * 파일명       : noticedetail.blade.php
 * 이력         :   v001 0614 이동호 new
**************************************************/
--}}

@extends('layout.layout')

@section('title', '공지사항')

@section('css')
    <link rel="stylesheet" href="{{asset('css/noticeDetail.css')}}">
@endsection

@section('contents')
    @include('layout.inc.notice')
    <div class="nDetailContainer">
        <hr>
        <div class="nTitle">
            <div class="nTitleText">
                {{$data->notice_title}}
            </div>
        </div>
        <div class="nContent">
            {{$data->notice_content}}
        </div>
    </div>
    <div class="nButtons">
        {{-- TODO : 관리자권한일시 수정버튼 출력 --}}
        {{-- TODO : 관리자권한일시 삭제버튼 출력 --}}
        @if(Auth::user()->admin_flg === '1')
            관리자당
        @endif
        <button type="button" onclick="location.href = '{{route('notice.index')}}'">리스트</button>
    </div>
@endsection

@section('js')
    {{-- <script src="{{asset('js/js 파일 이름.js')}}"></script> --}}
@endsection