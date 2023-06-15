@extends('layout.layout')

@section('title', 'Mail')

@section('contents')
    <h1>이메일 인증</h1>

    <form action="{{route('mails.mail.post')}}" method="post">
        @csrf
        <label for="u_email">Email : </label>
        <input type="text" name="u_email" id="email">

        <button type="submit">이메일 받기</button>
    </form>

@endsection