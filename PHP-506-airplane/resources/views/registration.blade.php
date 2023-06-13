{{-- 
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views
 * 파일명       : registration.blade.php
 * 이력         :   v001 0612 박수연 new
**************************************************/
--}}

@extends('layout.layout')

@section('title', 'Registration')

@section('contents')
    <h1>회원가입</h1>
    {{-- @include('layout.errorsvalidate') --}}
    <form action="{{route('users.registration.post')}}" method="post">
        @csrf
        <label for="name">이름 : </label>
        <input type="text" name="name" id="name">
        <br>
        <label for="email">이메일 : </label>
        <input type="text" name="email" id="email">
        <br>
        <label for="password">비밀번호 : </label>
        <input type="password" name="password" id="password">
        <br>
        <label for="passwordchk">비밀번호 확인 : </label>
        <input type="password" name="passwordchk" id="passwordchk">
        <br>
        <label for="birth">생년월일 : </label>
        <input type="date" name="birth" value="xxx" min="1900-01-01" max="now()">
        <br>
        <label for="gender">성별 : </label>
        <input type="radio" name="gender" id="gender_m" value="M">M
        <input type="radio" name="gender" id="gender_f" value="F">F
        <br>
        <div>
            <span>이메일 찾기 힌트를 선택해주세요</span>
        </div>
        <br>
        <select name="myselect" id="myselect">
            <option value="1"  selected='selected'>--------선택--------</option>
            <option value="2">기억에 남는 추억의 장소는?</option>
            <option value="3">나의 보물 제1호는?</option>
            <option value="4">가장 기억에 남는 영화는?</option>
            <option value="5">우리집 애완동물의 이름은?</option>
        </select>
        <br>
            <label for="answer">답 : </label>
            <input type="text" name="answer" id="answer">
        <br>
        <button type="submit">가입하기</button>
        <button type="button" onclick="location.href = '{{route('users.login')}}'">Cancel</button>
    </form>
@endsection