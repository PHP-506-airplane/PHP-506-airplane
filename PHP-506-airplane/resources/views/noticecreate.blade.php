{{-- 
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views
 * 파일명       : noticecreate.blade.php
 * 이력         :   v001 0615 이동호 new
**************************************************/
--}}

@extends('layout.layout')

@section('title', '공지사항')

@section('css')
    <link rel="stylesheet" href="{{asset('css/noticeCreate.css')}}">
@endsection

@section('contents')
    @include('layout.inc.notice')
    <div class="nCreateContainer">
        <form action="{{route('notice.store')}}" method="POST" class="formCreate">
            @csrf
            <label for="title" class="labelTitle">제목 : </label>
            <input type="text" name="title" id="title" class="inputText">
            <hr>
            <label for="content"></label>
            <textarea name="content" id="content" class="textareaContent"></textarea>
            <div class="divCreateBtns">
                <div class="nCreateBtns">
                    <button type="submit">작성</button>
                    <button type="button" onclick="location.href='{{route('notice.index')}}'">취소</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    {{-- <script src="{{asset('js/js 파일 이름.js')}}"></script> --}}
@endsection