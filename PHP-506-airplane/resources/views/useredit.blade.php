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

@section('css') 
    <link rel="stylesheet" href="{{asset('css/useredit.css')}}">
@endsection

@section('contents')

    {{-- <form action="{{route('users.useredit.post',['users' => $data->id])}}" method="post">
        <h1>회원정보 수정</h1>
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
        </script>
        <br>
        <button type="submit">수정</button>
        <button type="button" onclick="location.href='{{Route('reservation.main')}}'">취소</button>
        <button type="button" onclick="location.href='{{Route('users.chgpw')}}'">비밀번호 수정</button>
        <button type="button" class="div1" onclick="location.href='{{Route('users.withdraw')}}'">회원탈퇴</button>
        
    </form> --}}

<form action="{{route('users.useredit.post',['users' => $data->id])}}" method="post">
    @csrf
    @method('put')
    <div class="wrap">
            <div class="login">
                <h2>회원정보 수정</h2>
                <div class="login_id">
                    <label for="u_name">이름 : </label>
                    <input type="text" name="u_name" id="u_name" value="{{count($errors) > 0 ? old('u_name') : $data->u_name}}" placeholder="">
                </div>
                <div class="login_id">
                    <label for="u_email">이메일 : </label>
                    <input type="text" name="u_email" id="u_email" value="{{count($errors) > 0 ? old('u_email') : $data->u_email}}" readonly placeholder="">
                </div>
                <div class="login_id">
                    <label for="u_birth">생년월일 : </label>
                    <input type="text" name="u_birth" id="u_birth" value="{{count($errors) > 0 ? old('u_birth') : $data->u_birth}}" readonly placeholder="">
                </div>
                <div class="submit">
                    <input type="submit" value="수정">
                </div>
                <div class="submit2">
                    <input type="button" value="회원탈퇴" onclick="location.href = '{{route('users.withdraw')}}'">
                </div>
                <div class="submit2">
                    <input type="button" value="취소" onclick="location.href = '{{route('reservation.main')}}'">
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@section('js')
    <script src="{{asset('js/delete.js')}}"></script>
@endsection