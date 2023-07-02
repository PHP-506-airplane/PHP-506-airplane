<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            margin: 0;
            background: radial-gradient(ellipse farthest-corner at center top, #cbf49a, #1ea623);
            color: #363c44;
            font-size: 14px;
            font-family: 'Roboto', sans-serif;
        }

        .center {
            position: relative;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

    /*--------------------
    Boarding Pass
    --------------------*/
    .passContainer {
        max-width: 800px;
        margin: 30px auto;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
    }

    .boarding-pass {
        width: 350px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 5px 30px rgba(0, 0, 0, .2);
        overflow: hidden;
        text-transform: uppercase;
        margin: 30px auto;
        display: inline-block;
        border: 1px solid #ccc
    }

    .boarding-pass small {
        display: block;
        font-size: 11px;
        color: #A2A9B3;
        margin-bottom: 2px;
    }

    .boarding-pass strong {
        font-size: 15px;
        display: block;
    }

    /*--------------------
    Header
    --------------------*/
    .boarding-pass header {
        background: linear-gradient(to bottom, #36475f, #2c394f);
        padding: 12px 20px;
        height: 53px;
        /* width: 360px;
        margin-left: -15px; */
    }

    .boarding-pass header .logo {
        float: left;
        color: #fff;
        line-height: 30px;
    }

    .boarding-pass header .flight {
        float: left;
        color: #fff;
    }

    .boarding-pass header .flight small {
        font-size: 8px;
        margin-bottom: 2px;
        opacity: 0.8;
    }

    .boarding-pass header .flight strong {
        font-size: 18px;
    }

    /*--------------------
    Cities
    --------------------*/
    .boarding-pass .cities {
        position: relative;
        display: flex;
        justify-content: space-between;
    }

    .boarding-pass .cities::after {
        content: '';
        display: table;
        clear: both;
    }

    .boarding-pass .cities .city {
        padding: 20px 18px;
        /* float: left; */
    }

    .boarding-pass .cities .city:nth-child(2) {
        /* float: right; */
        margin-left: auto;
    }

    .boarding-pass .cities .city strong {
        font-size: 40px;
        font-weight: 300;
        line-height: 1;
    }

    .boarding-pass .cities .city small {
        margin-bottom: 0px;
        margin-left: 3px;
    }

    .boarding-pass .cities .airplane {
        position: absolute;
        width: 30px;
        height: 25px;
        top: 57%;
        left: 30%;
        opacity: 0;
        transform: translate(-50%, -50%);
        animation: move 4s infinite;
    }

    @keyframes move {
        40% {
            left: 50%;
            opacity: 1;
        }
        100% {
            left: 70%;
            opacity: 0;
        }
    }

    /*--------------------
    Infos
    --------------------*/
    .boarding-pass .infos {
        display: flex;
        border-top: 1px solid #99D298;
    }

    .boarding-pass .infos .places,
    .boarding-pass .infos .times {
        width: 50%;
        padding: 10px 0;
    }

    .boarding-pass .infos .times strong {
        transform: scale(0.9);
        transform-origin: left bottom;
    }

    .boarding-pass .infos .places {
        background: #E2EFE2;
        border-right: 1px solid #99D298;
    }

    .boarding-pass .infos .places small {
        color: #97A1AD;
    }

    .boarding-pass .infos .places strong {
        color: #239422;
    }

    .boarding-pass .infos .box {
        padding: 10px 20px 10px;
        width: 47%;
        float: left;
    }

    .boarding-pass .infos .box small {
        font-size: 10px;
    }

    /*--------------------
    Strap
    --------------------*/
    .boarding-pass .strap {
        clear: both;
        position: relative;
        border-top: 1px solid #99D298;
    }

    .boarding-pass .strap::after {
        content: '';
        display: table;
        clear: both;
    }

    .boarding-pass .strap .box {
        padding: 23px 0 20px 20px;
    }

    .boarding-pass .strap .box div {
        margin-bottom: 15px;
    }

    .boarding-pass .strap .box div small {
        font-size: 10px;
    }

    .boarding-pass .strap .box div strong {
        font-size: 13px;
    }

    .boarding-pass .strap sup {
        font-size: 8px;
        position: relative;
        top: -5px;
    }

    .boarding-pass .strap .qrcode {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 80px;
        height: 80px;
    }

    /* QR코드 */
    img {
        width: 80px;
        height: 80px;
        display: inline-block;
        position: absolute;
        bottom: 45px;
        left: 250px;
    }
    /* /QR코드 */

    </style>
</head>
<body>
    {{-- <div>
        <div>안녕하세요, {{ $user->u_name }}님.</div>
    <div>예약하신 항공편 입니다.</div>
    {!!'flyno : ' . strtoupper($reserveData->fly_no) . '<br>'!!}
    {!!'resno : ' . strtoupper($reserveData->reserve_no) . '<br>'!!}
    {!!'편명 : ' . strtoupper($reserveData->flight_num) . '<br>'!!}
    {!!'항공사 : ' . $reserveData->line_name . '<br>'!!}
    {!!'항공사 코드 : ' . $reserveData->line_code . '<br>'!!}
    {!!'비행기 이름 : ' . $reserveData->plane_name . '<br>'!!}
    {!!'예약자 이름 : ' . $reserveData->u_name . '<br>'!!}
    {!!'좌석 : ' . $reserveData->seat_no . '<br>'!!}
    {!!'날짜 : ' . $reserveData->fly_date . '<br>'!!}
    {!!'출발 시간 : ' . $reserveData->dep_time . '<br>'!!}
    {!!'도착 시간 : ' . $reserveData->arr_time . '<br>'!!}
    {!!'소요 시간 : ' . TimeCalculation($reserveData->dep_time, $reserveData->arr_time) . '<br>'!!}
    {!!'출발 : ' . $reserveData->dep_port_name . '<br>'!!}
    {!!'도착 : ' . $reserveData->arr_port_name . '<br>'!!}
    </div> --}}
    <div class="boarding-pass">
        <header>
            <div class="flight">
                <strong>{{$reserveData->line_name}}</strong>
            </div>
        </header>
        <section class="cities">
            <div class="city">
                <small>{{str_replace('공항', '' , $reserveData->dep_port_name)}}</small>

                <strong>{{strtoupper($reserveData->dep_port_eng)}}</strong>
            </div>
            <div class="city cityRight" style="margin-left: 100px;">
                <small>{{str_replace('공항', '' , $reserveData->arr_port_name)}}</small>

                <strong>{{strtoupper($reserveData->arr_port_eng)}}</strong>
            </div>
            <svg class="airplane">
                <use xlink:href="#airplane"></use>
            </svg>
        </section>
        <section class="infos">
            <div class="places">
                <div class="box">
                    <small>Linecode</small>
                    <strong><em>{{$reserveData->line_code}}</em></strong>
                </div>
                <div class="box">
                    <small>airplane</small>
                    <strong><em>{{$reserveData->plane_name}}</em></strong>
                </div>
                <div class="box">
                    <small>Seat</small>
                    <strong>{{$reserveData->seat_no}}</strong>
                </div>
                <div class="box">
                    <small>Flight</small>
                    <strong>{{$reserveData->flight_num}}</strong>
                </div>
            </div>
            <div class="times">
                <div class="box">
                    <small>Date</small>
                    <strong>{{substr($reserveData->fly_date, 5)}}</strong>
                </div>
                <div class="box">
                    <small>Departure</small>
                    <strong>{{substr($reserveData->dep_time, 0, 2) . ':' . substr($reserveData->dep_time, 2)}}</strong>
                </div>
                <div class="box">
                    <small>Duration</small>
                    <strong>{{TimeCalculation($reserveData->dep_time, $reserveData->arr_time)}}</strong>
                </div>
                <div class="box">
                    <small>Arrival</small>
                    <strong>{{substr($reserveData->arr_time, 0, 2) . ':' . substr($reserveData->arr_time, 2)}}</strong>
                </div>
            </div>
        </section>
        <section class="strap">
            <div class="box">
                <div class="passenger">
                    <small>passenger</small>
                    <strong>{{$reserveData['u_name']}}</strong>
                </div>
            </div>
            <img src="{{$message->embed(public_path() . '/img/qr.png')}}" alt="QR code" class="imgQr">
        </section>
    </div>

    <svg xmlns="http://www.w3.org/2000/svg" width="0" height="0" display="none">
        <symbol id="airplane" viewBox="243.5 245.183 25 21.633">
            <g>
                <path fill="#30af2f" d="M251.966,266.816h1.242l6.11-8.784l5.711,0.2c2.995-0.102,3.472-2.027,3.472-2.308
                                        c0-0.281-0.63-2.184-3.472-2.157l-5.711,0.2l-6.11-8.785h-1.242l1.67,8.983l-6.535,0.229l-2.281-3.28h-0.561v3.566
                                        c-0.437,0.257-0.738,0.724-0.757,1.266c-0.02,0.583,0.288,1.101,0.757,1.376v3.563h0.561l2.281-3.279l6.535,0.229L251.966,266.816z
                                        " />
            </g>
        </symbol>
    </svg>
</body>
</html>
