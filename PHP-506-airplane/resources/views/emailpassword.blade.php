@extends('layout.layout')

@section('title', 'Login')

@section('contents')
    <h1>로그인</h1>
    {{-- @include('layout.errorsvalidate') --}}

    <form action="{{route('users.login.post')}}" method="post">
        @csrf
        <label for="email">Email : </label>
        <input type="text" name="email" id="email">

        <label for="password">password : </label>
        <input type="password" name="password" id="password">

        <button type="button" onclick="location.href = '{{route('users.registration')}}'">Registration</button>
    </form>

@endsection

