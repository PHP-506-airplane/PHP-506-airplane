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
<div id="type" data-type="{{ $type }}"></div>
<div id="con" class="find">
    <div class="tabs find_form">
        {{-- 탭 선택 --}}
        <div style="text-align: center;">
            <a class="tab" id="idTab">이메일 찾기</a>
            <a class="tab" id="pwTab">비밀번호 찾기</a>
        </div>
        <br>
        <br>
        {{-- /탭 선택 --}}

        {{-- 이메일 찾기 탭 --}}
        <div class="tabContent" id="idContent">
            <h3 style="text-align: center;">이메일 찾기</h3>
            <hr>
            <form id="emailFindForm" method="POST">
                @csrf
                <p style="text-align: left; font-size:12px; color:#666">이름</p>
                <input type="text" placeholder="이름" name="name" value="{{ old('name') }}">
                <br>
                <p style="text-align: left; font-size:12px; color:#666">생일</p>
                <input type="date" placeholder="생일" name="birth" id="birth" value="{{ old('birth') }}">
                <br>
                <p style="text-align: left; font-size:12px; color:#666">이메일 찾기 질문</p>
                <select name="qa_no" value="{{ old('qa_no') }}">
                    <option value="0">기억에 남는 추억의 장소는?</option>
                    <option value="1">나의 보물 제1호는?</option>
                    <option value="2">가장 기억에 남는 영화는?</option>
                    <option value="3">우리집 애완동물의 이름은?</option>
                </select>
                <br>
                <p style="text-align: left; font-size:12px; color:#666">질문의 답변</p>
                <input type="text" placeholder="질문의 답변" name="qa_anw">
                <br>
                <span id="resultSpan"></span>
                <div style="text-align: center">
                    <button type="button" id="emailFindButton" class="btn">이메일 찾기</button>
                    <br>
                    <button type="button" onclick="location.href='{{ route('users.login'); }}'" class="btn">취소</button>
                </div>
            </form>
        </div>
        {{-- /이메일 찾기 탭 --}}

        {{-- 비밀번호 찾기 탭 --}}
        <div class="tabContent" id="pwContent">
            <h3 style="text-align: center;">비밀번호 찾기</h3>
            <hr>
            <form id="pwFindForm" method="POST">
                @csrf
                <p style="text-align: left; font-size:12px; color:#666">이메일</p>
                <input type="text" placeholder="이메일" name="email" value="{{ old('email') }}">
                <br>
                <p style="text-align: left; font-size:12px; color:#666">이름</p>
                <input type="text" placeholder="이름" name="name" value="{{ old('name') }}">
                <br>
                <p style="text-align: left; font-size:12px; color:#666">비밀번호 찾기 질문</p>
                <select name="qa_no" value="{{ old('qa_no') }}">
                    <option value="0">기억에 남는 추억의 장소는?</option>
                    <option value="1">나의 보물 제1호는?</option>
                    <option value="2">가장 기억에 남는 영화는?</option>
                    <option value="3">우리집 애완동물의 이름은?</option>
                </select>
                <br>
                <p style="text-align: left; font-size:12px; color:#666">질문의 답변</p>
                <input type="text" placeholder="질문의 답변" name="qa_anw">
                <br>
                <div style="text-align: center">
                    <button type="button" id="pwFindButton" class="btn">비밀번호 찾기</button>
                    <br>
                    <button type="button" onclick="location.href='{{ route('users.login'); }}'" class="btn">취소</button>
                </div>
            </form>
        </div>
        {{-- /비밀번호 찾기 탭 --}}
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('js/find.js')}}"></script>
@endsection
