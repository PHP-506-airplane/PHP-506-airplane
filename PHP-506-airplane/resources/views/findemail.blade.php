@extends('layout.layout')

@section('title', 'Login')

@section('contents')
    <h1>이메일 찾기</h1>
    <br>
    <form action="{{route('users.login.post')}}" method="post">
        @csrf
        <label for="name">Name : </label>
        <input type="text" name="name" id="name">
        <br>
        <label for="email">Email : </label>
        <input type="text" name="email" id="email">
        <br>
        <br>

        <div>
            <span>이메일 찾기 힌트를 선택해주세요</span>
        </div>

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

        <button type="submit" onclick="location.href = '{{route('emails.email')}}'">이메일 발송</button>
        <button type="button" onclick="location.href = '{{route('users.login')}}'">취소</button>
    </form>

@endsection

