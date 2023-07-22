@extends('layout.layout')

@section('title', '관리자 페이지')

@section('css')
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('contents')
    <div class="adminHeader"><span onclick="location.href='{{ route('admin.index'); }}'" id="headerSpan">Shoong 관리자 페이지</span></div>
    <div id="cont">
        <div>
            <form id="searchForm" method="GET" style="margin: 20px;" action="{{ route('admin.search') }}">
                @csrf
                <input type="date" name="dateStart" id="dateStart" value="{{ $today }}">
                <span> → </span>
                <input type="date" name="dateEnd" id="dateEnd" value="{{ $today }}">
                <select name="airline" id="airline">
                    <option value="0">항공사</option>
                    @foreach($airLine as $val)
                        <option value="{{ $val->line_no }}">{{ $val->line_name }}</option>
                    @endforeach
                </select>
                <select name="depPort" id="depPort">
                    <option value="0">출발지</option>
                    @foreach($port as $val)
                        <option value="{{ $val->port_no }}">{{ str_replace('공항', '', $val->port_name) }}</option>
                    @endforeach
                </select>
                <span> → </span>
                <select name="arrPort" id="arrPort">
                    <option value="0">도착지</option>
                    @foreach($port as $val)
                    <option value="{{ $val->port_no }}">{{ str_replace('공항', '', $val->port_name) }}</option>
                    @endforeach
                </select>
                <select name="state" id="State">
                    <option value="0">결항 여부</option>
                    <option value="1">정상</option>
                    <option value="2">결항</option>
                </select>
                <button type="submit" id="searchBtn" class="btn btn-outline-dark btn-sm" onclick="showLoading();">검색</button>
            </form>
        </div>
        <div id="resultDiv" class="container">
            {{-- 검색 결과 출력부분 --}}
            <div class="row" id="row">
                <div class="col">날짜</div>
                <div class="col">편명</div>
                <div class="col">항공사</div>
                <div class="col">출발지</div>
                <div class="col">도착지</div>
                <div class="col">출발</div>
                <div class="col">도착</div>
                <div class="col">예약석</div>
                <div class="col">결항</div>
            </div>
            <div id="resultRow">
                @forelse($data as $item)
                    <div class="row">
                        <div class="col">{{ $item->fly_date }}</div>
                        <div class="col">{{ Str::upper($item->flight_num) }}</div>
                        <div class="col">{{ $item->line_name }}</div>
                        <div class="col after">{{ str_replace('공항', '', $item->dep_port_name) }}</div>
                        <div class="col">{{ str_replace('공항', '', $item->arr_port_name) }}</div>
                        <div class="col after">{{ substr($item->dep_time, 0, 2) . ':' . substr($item->dep_time, 2) }}</div>
                        <div class="col">{{ substr($item->arr_time, 0, 2) . ':' . substr($item->arr_time, 2) }}</div>
                        <div class="col">{{ $item->count }}석</div>
                        <div class="col">
                            {{-- <button type="button" class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#editModal">지연</button> --}}
                            @if($item->deleted_at)
                                <span>{{ $item->del_reason }}</span>
                            @else
                                <button type="button" 
                                    class="btn btn-outline-dark btn-sm delete-btn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal" 
                                    data-item-id="{{ $item->fly_no }}" 
                                    onclick="setModalData(
                                            '{{ $item->fly_date }}'
                                            ,'{{ Str::upper($item->flight_num) }}'
                                            ,'{{ $item->line_name }}'
                                            ,'{{ str_replace('공항', '', $item->dep_port_name) }}'
                                            ,'{{ str_replace('공항', '', $item->arr_port_name) }}'
                                            ,'{{ substr($item->dep_time, 0, 2) . ':' . substr($item->dep_time, 2) }}'
                                            ,'{{ substr($item->arr_time, 0, 2) . ':' . substr($item->arr_time, 2) }}'
                                            ,'{{ $item->count }}석', '{{ $item->fly_no }}'
                                        )">
                                        결항
                                </button>
                            @endif
                        </div>
                    </div>
                    <hr>
                @empty
                <div class="row">
                    <div>데이터가 없습니다.</div>
                </div>
                <hr>
                @endforelse
            </div>
            <div class="paginate">
                {{-- {{ $data->links('vendor.pagination.custom') }} --}}
                {{ $data->appends(request()->except('page'))->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>

    {{-- 모달 --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">항공편 결항 확인</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-3">날짜</div>
                        <div class="col col-6"><span id="itemDate"></span></div>
                    </div>
                    <div class="row">
                        <div class="col col-3">편명</div>
                        <div class="col col-6"><span id="itemName"></span></div>
                    </div>
                    <div class="row">
                        <div class="col col-3">항공사</div>
                        <div class="col col-6"><span id="itemAirline"></span></div>
                    </div>
                    <div class="row">
                        <div class="col col-3">출발지</div>
                        <div class="col col-6"><span id="itemDepPort"></span></div>
                    </div>
                    <div class="row">
                        <div class="col col-3">도착지</div>
                        <div class="col col-6"><span id="itemArrPort"></span></div>
                    </div>
                    <div class="row">
                        <div class="col col-3">출발시간</div>
                        <div class="col col-6"><span id="itemDepTime"></span></div>
                    </div>
                    <div class="row">
                        <div class="col col-3">도착시간</div>
                        <div class="col col-6"><span id="itemArrTime"></span></div>
                    </div>
                    <div class="row">
                        <div class="col col-3">예약석</div>
                        <div class="col col-6"><span id="itemSeatCount"></span></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearModalData()">취소</button>
                    <form id="deleteForm" method="post" action="{{ route('admin.delete'); }}">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="fly_no" id="flightId">
                        <button type="button" id="delBtn" class="btn btn-danger" onclick="showLoading();">결항</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('js/admin.js')}}"></script>
@endsection