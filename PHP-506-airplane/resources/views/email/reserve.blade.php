<h1><span style="color: skyblue;">{{ $user->u_name }}</span>님, 예약하신 항공편입니다.</h1>
<br>
<p>항공사 : <strong>{{ $reserveData['line_name'] }}</strong></p>
<p>편명 : <strong>{{ $reserveData['flight_num'] }}</strong></p>
<p>출발 : <strong>{{ str_replace('공항', '' , $reserveData['dep_port_name']) }}</strong></p>
<p>도착 : <strong>{{ str_replace('공항', '' , $reserveData['arr_port_name']) }}</strong></p>
<p>날짜 : <strong>{{ $reserveData['fly_date'] }}</strong></p>
<p>출발 시간 : <strong>{{ substr($reserveData['dep_time'], 0, 2) . ' : ' . substr($reserveData['dep_time'], 2) }}</strong></p>
<p>도착 시간 : <strong>{{ substr($reserveData['arr_time'], 0, 2) . ' : ' . substr($reserveData['arr_time'], 2) }}</strong></p>
<img src="{{$message->embed(public_path() . '/img/qr.png')}}" alt="QR code" class="imgQr" style="box-sizing: border-box;width: 80px;height: 80px;display: inline-block;position: absolute;bottom: 45px;left: 250px;">
