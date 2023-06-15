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

@section('contents')
<form action="{{route('users.useredit.post',['users' => $data->id])}}" method="post">
        @csrf
        @method('put')
        <label for="u_name">이름 : </label>
        <input type="text" name="u_name" id="name" value="{{count($errors) > 0 ? old('u_name') : $data->u_name}}">
        <br>
        <label for="u_email">이메일 : </label>
        <input type="text" name="u_email" id="email" value="{{count($errors) > 0 ? old('u_email') : $data->u_email}}" readonly>
        <br>
        <label for="u_birth">생년월일 : </label>
        <input type="date" name="u_birth" id="birth" value="{{count($errors) > 0 ? old('u_birth') : $data->u_birth}}" readonly>
        <br>
        {{-- <label for="u_gender">성별 : </label>
        <input type="radio" name="u_gender" id="gender" value="M">남
        <input type="radio" name="u_gender" id="gender" value="F">여
        <script>
            var radioVal = $('input:radio[name="gender"]:checked').val();
            alert(radioVal); 
        </script> --}}
        <br>
        <button type="submit">수정</button>
        <button type="button" onclick="location.href='{{Route('reservation.main')}}'">취소</button>
        <button type="button" onclick="location.href='{{Route('users.withdraw')}}'">회원탈퇴</button>
    </form>
@endsection