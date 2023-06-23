<div>
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
</div>