{{-- 
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views
 * 파일명       : useredit.blade.php
 * 이력         :   v001 0613 박수연 new
**************************************************/
--}}
@extends('layout.layout')

@section('title', '회원정보 수정')

<form action="{{route('users.useredit',['users' => $data->id])}}" method="post">
        @csrf
        @method('put')
        <label for="name">이름 : </label>
        <input type="text" name="name" id="name" value="{{count($errors) > 0 ? old('name') : $data->u_name}}">
        <br>
        <label for="email">이메일 : </label>
        <input type="text" name="email" id="email" value="{{count($errors) > 0 ? old('email') : $data->u_email}}" readonly>
        <br>
        <label for="birth">생년월일 : </label>
        <input type="date" name="birth" id="birth" value="{{count($errors) > 0 ? old('birth') : $data->u_birth}}">
        <br>
        <label for="gender">성별 : </label>
        <input type="radio" name="gender" id="gender" value="M">남
        <input type="radio" name="gender" id="gender" value="F">여
        <script>
            var radioVal = $('input:radio[name="gender"]:checked').val();
            alert(radioVal); 
        </script>
        <br>
        <button type="submit">수정</button>
        <button type="button" onclick="location.href='{{Route('users.login')}}'">취소</button>
        <button type="button" onclick="location.href='{{Route('users.withdraw')}}'">회원탈퇴</button>
        

        
    </form>