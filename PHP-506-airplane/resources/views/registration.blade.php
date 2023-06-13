@extends('layout.layout')

@section('title', 'Registration')

@section('contents')
    <h1>회원가입</h1>
    {{-- @include('layout.errorsvalidate') --}}
    <form action="{{route('users.registration.post')}}" method="post">
        @csrf
        <label for="name">name : </label>
        <input type="text" name="name" id="name">
        <br>
        <label for="email">Email : </label>
        <input type="text" name="email" id="email">
        <br>
        <label for="password">password : </label>
        <input type="password" name="password" id="password">
        <br>
        <label for="passwordchk">password : </label>
        <input type="password" name="passwordchk" id="passwordchk">
        <br>
        <div>
            <span>이메일 찾기 힌트를 선택해주세요</span>
        </div>
        <br>
        <select name="myselect" id="myselect">
            <option value="1"  selected='selected'>기억에 남는 추억의 장소는?</option>
            <option value="2">나의 보물 제1호는?</option>
            <option value="3">가장 기억에 남는 영화는?</option>
            <option value="4">우리집 애완동물의 이름은?</option>
        </select>
        <br>
        <form action="{{route('users.emailanswer.post')}}" method="post">
            <label for="answer">답 : </label>
            <input type="text" name="answer" id="answer">
        </form>
        <br>
        <button type="submit">Registration</button>
        <button type="button" onclick="location.href = '{{route('users.login')}}'">Cancel</button>
    </form>
@endsection