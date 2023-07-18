{{--
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : views
 * 파일명       : cancelreserve.blade.php
 * 이력         :   v001 0718 오재훈 new
**************************************************/
--}}

@extends('layout.layout')

@section('title', '예약 환불')

@section('css')
<link rel="stylesheet" href="{{asset('css/refundticket.css')}}">
@endsection

@section('contents')
<div class="container total">
    <div class="boarding-pass">
        <header>
            <div class="flight">
                <strong></strong>
            </div>
        </header>
        <section class="cities">
            <div class="city">
                <small></small>
                <strong></strong>
            </div>
            <div class="city">
                <small></small>
                <strong></strong>
            </div>
            <svg class="airplane">
                <use xlink:href="#airplane"></use>
            </svg>
        </section>
        <section class="infos">
            <div class="places">
                <div class="box">
                    <small>Linecode</small>
                    <strong><em></em></strong>
                </div>
                <div class="box">
                    <small>airplane</small>
                    <strong><em></em></strong>
                </div>
                <div class="box">
                    <small>Seat</small>
                    <strong></strong>
                </div>
                <div class="box">
                    <small>Flight</small>
                    <strong></strong>
                </div>
            </div>
            <div class="times">
                <div class="box">
                    <small>Date</small>
                    <strong></strong>
                </div>
                <div class="box">
                    <small>Departure</small>
                    <strong></strong>
                </div>
                <div class="box">
                    <small>Duration</small>
                    <strong></strong>
                </div>
                <div class="box">
                    <small>Arrival</small>
                    <strong></strong>
                </div>
            </div>
        </section>
        <section class="strap">
            <div class="box">
                <div class="passenger">
                    <small>passenger</small>
                    <strong></strong>
                </div>
            </div>
            {{-- <img src="{{asset('img/qr.png')}}" alt="QR code" class="imgQr"> --}}
        </section>
    </div>
</div>
@endsection

@section('js')
{{-- <script src="{{asset('js/myreservation.js')}}"></script> --}}
@endsection