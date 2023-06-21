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
    {{-- 에러메세지 --}}
    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <div>{{$error}}</div>
            @endforeach
        </div>
    @endif
    {{-- /에러메세지 --}}
        <form action="{{route('notice.update', ['notice' => $data->notice_no])}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <label for="title">제목 : </label>
            <input type="text" name="title" id="title" value="{{count($errors) > 0 ? old('title') : $data->notice_title}}">  
            <br>
            <label for="content">내용 : </label>
            <textarea name="content" id="content" cols="30" rows="10">{{count($errors) > 0 ? old('content') : $data->notice_content}}</textarea>
            @if($data->image_path)
                <img src="{{asset($data->image_path . '?' . time())}}" alt="이미지">
            @endif
            <label for="image">이미지:</label>
            <input type="file" name="image" id="image">
            <button type="submit">수정</button>
            <button type="button" onclick="location.href='{{route('notice.show', ['notice' => $data->notice_no])}}'">취소</button>
        </form>
    </div>
@endsection

@section('js')
    {{-- <script src="{{asset('js/js 파일 이름.js')}}"></script> --}}
@endsection