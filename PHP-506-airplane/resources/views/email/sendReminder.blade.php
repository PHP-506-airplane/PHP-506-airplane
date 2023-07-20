<h1>예약하신 항공편의 출발 3시간 전입니다.</h1>
<p>항공사 : <strong>{{ $data->line_name }}</strong></p>
<p>출발 : <strong>{{ str_replace('공항', '' , $data->dep_port_name) }}</strong></p>
<p>도착 : <strong>{{ str_replace('공항', '' , $data->arr_port_name) }}</strong></p>
<p>날짜 : <strong>{{ $data->fly_date }}</strong></p>
<p>출발 시간 : <strong>{{ substr($data->dep_time, 0, 2) . ' : ' . substr($data->dep_time, 2) }}</strong></p>
<p>도착 시간 : <strong>{{ substr($data->arr_time, 0, 2) . ' : ' . substr($data->arr_time, 2) }}</strong></p>