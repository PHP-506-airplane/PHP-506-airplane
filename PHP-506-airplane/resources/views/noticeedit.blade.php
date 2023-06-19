{{-- 
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views
 * 파일명       : noticeedit.blade.php
 * 이력         :   v001 0615 이동호 new
**************************************************/
--}}

@extends('layout.layout')

@section('title', '공지사항')

@section('css')
    <link rel="stylesheet" href="{{asset('css/noticeEdit.css')}}">
@endsection

@section('contents')
    @include('layout.inc.notice')
    <div class="nEditContainer">
        <form action="{{route('notice.update', ['notice' => $data->notice_no])}}" method="POST">
            @csrf
            @method('put')
            <label for="title">제목 : </label>
            <input type="text" name="title" id="title" value="{{count($errors) > 0 ? old('title') : $data->notice_title}}">  
            <br>
            <label for="content">내용 : </label>
            <textarea name="content" id="content" cols="30" rows="10">{{count($errors) > 0 ? old('content') : $data->notice_content}}</textarea>
            <button type="submit">수정</button>
            <button type="button" onclick="location.href='{{route('notice.show', ['notice' => $data->notice_no])}}'">취소</button>
        </form>
    </div>
@endsection

@section('js')
    {{-- <script src="{{asset('js/js 파일 이름.js')}}"></script> --}}
@endsection