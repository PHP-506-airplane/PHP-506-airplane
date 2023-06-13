{{-- 
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views
 * 파일명       : noticelist.blade.php
 * 이력         :   v001 0612 이동호 new
**************************************************/
--}}

@extends('layout.layout')

@section('title', '공지사항')

@section('css')
    <link rel="stylesheet" href="{{asset('css/noticelist.css')}}">
@endsection

@section('contents')
    <div class="noticeMsg">
        <h1>공지사항</h1>
        <span>종이비행기 항공의 다양한 소식을 알려드립니다.</span>
    </div>
    <div class="nListContainer">
        <div class="listInfo row textCenter">
            <div class="col-2 afterLine">번호</div>
            <div class="col-8 afterLine">제목</div>
            <div class="col-2">등록일</div>
        </div>
        @forelse($data as $item)
        <hr>
        <div class="row mainContents">
            <div class="col-2 textCenter afterLine">{{$item->notice_no}}</div>
            <div class="col-8 afterLine"><a href="{{route('notice.show', ['notice' => $item->notice_no])}}">{{$item->notice_title}}</a></div>
            {{-- <div class="col colTitle"><a href="{{route('boards.show', ['board' => $item->id])}}" class="aTagNone">{{$item->title}}</a></div> --}}
            <div class="col-2 textCenter">{{mb_substr($item->created_at, 0, 10)}}</div>
        </div>
        @empty
        <div class="row">
            <div class="col"></div>
            <div class="col">게시글 없음</div>
            <div class="col"></div>
            <div class="col"></div>
        </div>
        @endforelse
    </div>
    <div class="paginate">
        {{ $data->links('vendor.pagination.custom') }}
    </div>
@endsection

@section('js')
    {{-- <script src="{{asset('js/js 파일 이름.js')}}"></script> --}}
@endsection