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
                <div class="space">
                </div>
                <div class="login_etc">
                    <div class="forgot_pw">
                        <a href="{{route('reservation.main')}}">취소</a>
                    </div>
                    <div class="forgot_pw">
                        <a href="{{route('users.chgpw')}}">비밀번호 변경</a>
                    </div>
                    <div class="forgot_pw">
                        <a href="{{ route('users.withdraw')}}" onclick="test()">회원탈퇴</a>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</form>
<form action="{{route('users.withdraw')}}" method="get" id="withdraw">
    <div class="forgot_pw">
        <button type="button" onclick="test()">회원탈퇴</button>
    </div>
</form> --}}

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
                <input type="submit" value="수정" class="btn">
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
                <div class="forgot_pw">
                    <a  onclick="test()" id="withdraw">회원탈퇴</a>
                </div> 
            </div>
        </form>
        </div>
    <div>
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

    
</script>
{{-- <script>
!confirm("탈퇴?")
function ConfirmTest() {
if (confirm("삭제 하시겠습니까?")) {
        return route('users.withdraw');
    }  
    else {
        return false;
    }
}
</script> --}}

{{-- function withdraw(){
  if (confirm("정말 탈퇴하시겠습니까??") == true){    //확인
      document.form.submit();
  }else{   //취소
      return;
  }
} --}}
@endsection