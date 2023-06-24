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
                <div class="space">
                </div>
                <div class="login_etc">
                    <div class="forgot_pw">
                        <a href="{{route('reservation.main')}}">취소</a>
                    </div>
                    <div class="forgot_pw">
                        <a href="{{route('users.chgpw')}}">비밀번호 변경</a>
                    </div>
                    {{-- <div class="forgot_pw">
                        <a href="{{ route('users.withdraw')}}" onclick="test()">회원탈퇴</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</form>
<form action="{{route('users.withdraw')}}" method="get" id="withdraw">
    <div class="forgot_pw">
        <button type="button" onclick="test()">회원탈퇴</button>
    </div>
</form>
@endsection

@section('js')
    <script src="{{asset('js/delete.js')}}"></script>
    <script>
    const seatForm = document.getElementById('withdraw');
    function test() {
        var con_test = confirm("정말 탈퇴 하시겠습니까?");
        if(con_test == true){
        seatForm.submit();
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