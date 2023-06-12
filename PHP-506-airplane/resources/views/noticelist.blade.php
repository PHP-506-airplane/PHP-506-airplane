@extends('layout.layout')

@section('title', '공지사항')

@section('css')
    <link rel="stylesheet" href="{{asset('css/noticelist.css')}}">
@endsection

@section('contents')
        <div class="nListContainer">
            <div class="listInfo row">
                <div class="col-2 textCenter afterLine">번호</div>
                <div class="col-7 afterLine">제목</div>
                <div class="col-3 textCenter">작성일</div>
            </div>
            <div class="listContents row">
                {{-- TODO : DB select 후 foreach --}}
                <div class="col-2 textCenter afterLine">1</div>
                <div class="col-7 afterLine">제목제목제목</div>
                <div class="col-3 textCenter">2023-06-12</div>
            </div>
        </div>
            {{-- TODO : 페이징 --}}
@endsection

@section('js')
    {{-- <script src="{{asset('js/js 파일 이름.js')}}"></script> --}}
@endsection