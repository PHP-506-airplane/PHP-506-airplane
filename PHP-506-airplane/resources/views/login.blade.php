{{-- 
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views
 * 파일명       : login.blade.php
 * 이력         :   v001 0612 박수연 new
**************************************************/
--}}

{{-- @extends('layout.layout')

@section('title', 'Login')

@section('contents')
    @include('errors.errorsvalidate')
    <h1>로그인</h1>
    <form action="{{route('users.login.post')}}" method="post">
        @csrf
        <label for="u_email">Email : </label>
        <input type="text" name="u_email" id="email" required>

        <label for="u_pw">password : </label>
        <input type="password" name="u_pw" id="password" required>
        <br>
        <button type="submit">Login</button>
        <button type="button" onclick="location.href = '{{route('findemails.findemail')}}'">이메일 찾기</button>
        <button type="button" onclick="location.href = '{{route('findpasswords.findpassword')}}'">비밀번호 찾기</button>
        <button type="button" onclick="location.href = '{{route('users.registration')}}'">회원가입</button>
    </form>

@endsection --}}

@extends('layout.layout')

@section('title', 'Login')

@section('css')
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection

@section('contents')
<div class="container right-panel-active">
<!-- Sign Up -->
<div class="container__form container--signup">
<form action="#" class="form" id="form1">
    <h2 class="form__title">Sign Up</h2>
    <input type="text" placeholder="User" class="input" />
    <input type="email" placeholder="Email" class="input" />
    <input type="password" placeholder="Password" class="input" />
    <button type="submit" class="btn">Sign Up</button>
</form>
</div>

<!-- Sign In -->
<div class="container__form container--signin">
<form action="#" class="form" id="form2">
    <h2 class="form__title">로그인</h2>
    <label for="u_email">Email : </label>
    <input type="text" name="u_email" id="email" required>

    <label for="u_pw">password : </label>
    <input type="password" name="u_pw" id="password" required>

    <a href="#" class="link">Forgot your password?</a>
    <button class="btn">Sign In</button>
</form>
</div>

<!-- Overlay -->
<div class="container__overlay">
<div class="overlay">
    <div class="overlay__panel overlay--left">
    <button class="btn" id="signIn">Sign In</button>
    </div>
    <div class="overlay__panel overlay--right">
    <button class="btn" id="signUp">Sign Up</button>
    </div>
</div>
</div>
</div>
@endsection

@section('js')
    <script src="{{asset('js/login.js')}}"></script>
@endsection