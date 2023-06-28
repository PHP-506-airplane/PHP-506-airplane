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

<div id="con">
    <div id="login">
        <div id="login_form">
        <form action="{{route('users.useredit.post',['users' => $data->id])}}" method="post" id="edit">
        @csrf
        @method('put')
            <h3 class="login" style="letter-spacing:-1px;">회원정보 수정</h3>
            <hr>
            <label>
            <p style="text-align: left; font-size:12px; color:#666">이름</p>
            <input type="text" name="u_name" id="u_name" value="{{count($errors) > 0 ? old('u_name') : $data->u_name}}" placeholder="">
            <p></p>
            </label>
            <br>
            <label>
            <p style="text-align: left; font-size:12px; color:#666">이메일</p>
            <input type="text" name="u_email" id="u_email" value="{{count($errors) > 0 ? old('u_email') : $data->u_email}}" disabled placeholder="">
            <p></p>
            </label>
            <br>
            <div style="height:30px"></div>
            <p>
                <input type="button" value="수정" class="btn" id="editBtn">
            </p>
            <div class="login_etc">
                <div class="space"></div>
                <div class="forgot_pw">
                    <a href="{{route('reservation.main')}}">취소</a>
                </div>
                <span>|</span>
                <div class="forgot_pw">
                    <a href="{{route('users.chgpw')}}">비밀번호 변경</a>
                </div>
                <span>|</span>
                <div class="forgot_pw" id="divWithdraw">
                    <a  onclick="test()" id="withdraw">회원탈퇴</a>
                </div> 
            </div>
        </form>
        </div>
</div>
@endsection

@section('js')
    <script src="{{asset('js/delete.js')}}"></script>
    <script>
    const withdraw = document.getElementById('withdraw');
    function test() {
        var con_test = confirm("정말 탈퇴 하시겠습니까?");
        if(con_test == true){
        location.href="{{ route('users.withdraw')}}";
    }
}

    // 0627이동호 쓰로틀링 ----------------------------------------------------------
    const editForm = document.getElementById('edit');
    const btn = document.getElementById('editBtn');

    throttle(btn, edit);
    // /0627이동호 쓰로틀링 ----------------------------------------------------------
</script>
@endsection