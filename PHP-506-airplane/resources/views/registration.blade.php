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

@section('css') 
    <link rel="stylesheet" href="{{asset('css/registration.css')}}">
@endsection

@section('contents')

<div id="con">
    <div id="login">
        <div id="login_form"><!--로그인 폼-->
            <form action="{{route('users.registration.post')}}" method="post" id="registForm">
                @csrf
                <h3 class="login" style="letter-spacing:-1px;">회원가입</h3>
                <hr>
                <label>
                <div>
                    <p style="text-align: left; font-size:12px; color:#666; margin-top:1rem">이름</p>
                    <input type="text" placeholder="한글 2~30글자 사이로 입력해주세요" class="size" name="name" id="name" oninput="chkName()" value="{{old('name')}}" autocomplete="off">
                    <div id="chk_name_msg"></div> 
                    @error('name')
                        <span class="errMsg">{{ $message }}</span>
                    @enderror
                </div>
                </label>
                <br>
                <label>
                    <div>
                        <p style="text-align: left; font-size:12px; color:#666; margin-top:1rem">이메일</p>
                        <input type="text" placeholder="이메일 형식에 맞게 써주세요" class="size" name="email" id="email" oninput="chkEmail()" onkeydown="clickedFalse()" value="{{old('email')}}" autocomplete="off">
                        <div id="chk_email_msg"></div>
                        @error('email')
                            <span class="errMsg">{{ $message }}</span>
                        @enderror
                        <br>
                        <button type="button" id="errMsgemail" onclick="chkEmail2()">이메일 중복 확인</button>
                    </div>
                </label> 
                <br>
                <label>
                <p style="text-align: left; font-size:12px; color:#666l margin-top:1rem">비밀번호</p>
                <input type="password" placeholder="비밀번호를 입력해주세요" class="size" oninput="chkPw()" name="password" id="password">
                </label>
                @error('password')
                    <span class="errMsg">{{ $message }}</span>
                @enderror
                <br>
                <label>
                    <p style="text-align: left; font-size:12px; color:#666; margin-top:1rem">비밀번호 확인</p>
                    <input type="password" placeholder="비밀번호 확인을 입력해주세요" class="size" oninput="chkPw()" name="passwordchk" id="pwchk">
                    <div id="chk_pw_msg"></div> 
                </label>
                @error('passwordchk')
                    <span class="errMsg">{{ $message }}</span>
                @enderror
                <br>
                <label>
                    <p style="text-align: left; font-size:12px; color:#666; margin-top:1rem">생년월일</p>
                    <input type="date" placeholder="생년월일을 입력해주세요" class="size" name="birth" id="u_birth" oninput="chkBirth()" value="{{old('birth')}}">
                    <div id="chk_birth_msg"></div> 
                    @error('birth')
                        <span class="errMsg">{{ $message }}</span>
                    @enderror
                </label>
                <br>
                <div class="gender">
                    <p style="text-align: left; font-size:12px; color:#666; margin-top:1rem" >성별</p>
                    <select class="size num1" name="gender" value="{{old('gender')}}">
                        <option value="0">남</option>
                        <option value="1">여</option>
                    </select>
                </div>
                @error('gender')
                    <span class="errMsg">{{ $message }}</span>
                @enderror
                <br>
                {{-- @if ($errors->any())
                    <div class="error">
                        @foreach ($errors->all() as $error)
                            <div>{{$error}}</div>
                        @endforeach
                    </div>
                @endif --}}
                <label>
                    <p style="text-align: left; font-size:12px; color:#666">아이디/비밀번호 찾기 질문</p>
                    <select class="size num1" name="qa_no" value="{{old('qa_no')}}">
                        <option value="0">기억에 남는 추억의 장소는?</option>
                        <option value="1">나의 보물 제1호는?</option>
                        <option value="2">가장 기억에 남는 영화는?</option>
                        <option value="3">우리집 애완동물의 이름은?</option>
                    </select>
                    @error('qa_no')
                        <span class="errMsg">{{ $message }}</span>
                    @enderror
                    <input type="text" placeholder="질문의 답을 입력해주세요." class="size" name="qa_answer" id="answer">
                </label>
                @error('qa_answer')
                    <span class="errMsg">{{ $message }}</span>
                @enderror
                <br>
                <p>
                    <button type="button" value="회원가입" class="btn" onclick="register()">회원가입</button>
                </p>
            </form>
            <hr>
            <p class="find">
                <span><a href="{{route('users.login')}}" >로그인 페이지로 이동</a></span>
            </p>
        </div>
    </div>
</div>

@endsection


@section('js')
    <script src="{{asset('js/chkPw.js')}}"></script>
    <script src="{{asset('js/checkemail.js')}}"></script>
    <script src="{{asset('js/registration.js')}}"></script>
@endsection