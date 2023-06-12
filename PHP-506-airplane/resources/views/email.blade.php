@extends('layout.layout')

@section('title', 'Email')

@section('contents')
    <h1>이메일 인증</h1>
    {{-- @include('layout.errorsvalidate') --}}

    {{-- <div>{!!session()->has('success') ? session('success') : ""!!}</div> --}}
    <form action="{{route('users.login.post')}}" method="post">
        @csrf
        <label for="email">Email : </label>
        <input type="text" name="email" id="email">

        <button type="submit">이메일 받기</button>
    </form>

@endsection