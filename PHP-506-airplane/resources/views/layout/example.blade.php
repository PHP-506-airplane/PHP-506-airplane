@extends('layout.layout')

@section('title', '타이틀 명')

@section('css')
    <link rel="stylesheet" href="{{asset('css/css파일 이름.css')}}">
@endsection

@section('contents')
    {{-- 각 페이지별 내용 --}}
@endsection

@section('js')
    <script src="{{asset('js/js 파일 이름.js')}}"></script>
@endsection