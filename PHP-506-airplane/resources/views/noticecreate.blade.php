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
    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <div>{{$error}}</div>
            @endforeach
        </div>
    @endif

    <form action="{{route('notice.store')}}" method="POST" class="formCreate" enctype="multipart/form-data">
        @csrf
        <label for="title" class="labelTitle">제목 : </label>
        <input type="text" name="title" id="title" class="inputText">
        <hr>
        <label for="content"></label>
        <div contentEditable="true" class="divContent" id="divContent" oninput="updateTextarea()">
                <img id="selectedImage" src="#" alt="선택된 이미지" class="noticeImg" style="display: none;">
        </div>
        <textarea name="content" id="content" class="textareaContent"></textarea>
        <input type="file" name="image" onchange="displaySelectedImage(event)">
        <div class="divCreateBtns">
            <div class="nCreateBtns">
                <button type="submit" class="btn btn-outline-success">작성</button>
                <button type="button" onclick="location.href='{{route('notice.index')}}'" class="btn btn-outline-danger">취소</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('js')
    <script src="{{asset('js/noticecreate.js')}}"></script>
@endsection