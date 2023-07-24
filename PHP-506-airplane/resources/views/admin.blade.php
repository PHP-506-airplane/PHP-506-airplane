@php
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $isMobile = preg_match('/iPhone|iPad|Android|iPod|ipod|blackberry|opera mobile/', $userAgent);
@endphp

@if($isMobile)
    <center><div style="font-size: 30px; margin-top: 500px;">이 페이지는 모바일 기기에서 접속하실 수 없습니다.</div></center>
    @php 
        exit; 
    @endphp
@endif

@extends('layout.layout')

@section('title', '관리자 페이지')

@section('css')
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('contents')
    <div class="adminHeader"><span onclick="location.href='{{ route('reservation.main'); }}'" id="headerSpan">Shoong</span><span onclick="location.href='{{ route('admin.index'); }}'" id="headerSpan"> 관리자 페이지</span></div>
    <div id="cont">
        <div id="divSearchForm">
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
                <button type="button" class="btn btn-outline-info btn-sm" id="addModalBtn" data-bs-toggle="modal" data-bs-target="#addModal">운항정보 추가</button>
            </form>
        </div>
        <div id="resultDiv" class="container">
            {{-- 검색 결과 출력부분 --}}
            <div class="row" id="row">
                <div class="col col-1">날짜</div>
                <div class="col">편명</div>
                <div class="col">항공사</div>
                <div class="col col-1">출발지</div>
                <div class="col-md-auto"></div>
                <div class="col col-1">도착지</div>
                <div class="col col-1">출발</div>
                <div class="col-md-auto"></div>
                <div class="col col-1">도착</div>
                <div class="col col-1">예약석</div>
                <div class="col col-1">지연 사유</div>
                <div class="col col-1">지연</div>
                <div class="col">결항</div>
            </div>
            <div id="resultRow">
                @forelse($data as $item)
                    <div class="row">
                        <div class="col">{{ $item->fly_date }}</div>
                        <div class="col">{{ Str::upper($item->flight_num) }}</div>
                        <div class="col">{{ $item->line_name }}</div>
                        <div class="col after col-1">{{ str_replace('공항', '', $item->dep_port_name) }}</div>
                        <div class="col-md-auto">→</div>
                        <div class="col col-1">{{ str_replace('공항', '', $item->arr_port_name) }}</div>
                        <div class="col after col-1">{{ substr($item->dep_time, 0, 2) . ':' . substr($item->dep_time, 2) }}</div>
                        <div class="col-md-auto">→</div>
                        <div class="col col-1">{{ substr($item->arr_time, 0, 2) . ':' . substr($item->arr_time, 2) }}</div>
                        <div class="col col-1">{{ $item->count > 0 ? $item->count . '석' : '-' }}</div>
                        <div class="col col-1">
                            @if ($item->delay_reasons === null)
                                -
                            @else
                                <button type="button" class="btn btn-outline-dark btn-sm" onclick="showDelayReasons('{{ $item->delay_reasons }}')">사유</button>
                            @endif
                        </div>
                        <div class="col">
                            @if($item->deleted_at)
                                <span class="colorRed">결항</span>
                            @else
                            <button 
                                type="button" 
                                class="btn btn-outline-warning btn-sm" 
                                id="editModalBtn" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editModal"
                                onclick="setEditModalData(
                                    '{{ $item->fly_date }}'
                                    ,'{{ Str::upper($item->flight_num) }}'
                                    ,'{{ $item->line_name }}'
                                    ,'{{ str_replace('공항', '', $item->dep_port_name) }}'
                                    ,'{{ str_replace('공항', '', $item->arr_port_name) }}'
                                    ,'{{ substr($item->dep_time, 0, 2) . ':' . substr($item->dep_time, 2) }}'
                                    ,'{{ substr($item->arr_time, 0, 2) . ':' . substr($item->arr_time, 2) }}'
                                    ,'{{ $item->count }}석', '{{ $item->fly_no }}'
                                )">
                                지연
                            </button>
                            @endif
                        </div>
                        <div class="col">
                            @if($item->deleted_at)
                                <span class="colorRed">{{ $item->del_reason }}</span>
                            @else
                                <button 
                                    type="button" 
                                    class="btn btn-outline-danger btn-sm delete-btn" 
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

    {{-- 모달창 : 결항 --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">항공편 결항</h5>
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
    {{-- /모달창 : 결항 --}}

    {{-- 모달 창: 운항정보 추가 --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">운항정보 추가</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="divAddForm" class="container">
                        <form id="addForm" method="post" action="{{ route('admin.store') }}">
                            @csrf
                            <span class="txt">편명</span>
                            <div class="row">
                                <input type="text" class="col" name="flightNum" placeholder="편명을 입력해주세요." id="flightNum">
                            </div>
                            <span class="txt">운항일</span>
                            <div class="row">
                                <input type="date" class="col" name="flightDate" id="flightDate" value="{{ $today }}">
                            </div>
                            <span class="txt">항공사 / 항공기</span>
                            <div class="row">
                                <select name="airPlane" id="airPlane">
                                    <option value="0">항공기</option>
                                    @foreach($airPlane->sortBy('line_name') as $val)
                                        <option value="{{ $val->plane_no }}">{{ $val->line_name }} - {{ $val->plane_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="txt">출발지 / 도착지</span>
                            <div class="row">
                                <select name="depPort" id="depPort" class="col">
                                    <option value="0">출발지</option>
                                    @foreach($port as $val)
                                        <option value="{{ $val->port_no }}">{{ str_replace('공항', '', $val->port_name) }}</option>
                                    @endforeach
                                </select>
                                <div class="col col-1 arrow"> → </div>
                                <select name="arrPort" id="arrPort" class="col">
                                    <option value="0">도착지</option>
                                    @foreach($port as $val)
                                    <option value="{{ $val->port_no }}">{{ str_replace('공항', '', $val->port_name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="txt">출발 / 도착</span>
                            <div class="row">
                                <input type="text" class="col" name="depHour" placeholder="시">
                                <div class="col col-1 arrow"> : </div>
                                <input type="text" class="col" name="depMin" placeholder="분">
                                <div class="col col-1 arrow"> → </div>
                                <input type="text" class="col" name="arrHour" placeholder="시">
                                <div class="col col-1 arrow"> : </div>
                                <input type="text" class="col" name="arrMin" placeholder="분">
                            </div>
                            <span class="txt">가격</span>
                            <div class="row">
                                <input type="text" class="col" name="price" placeholder="가격을 입력해주세요." id="price">
                            </div>
                            <br>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">취소</button>
                    <button type="submit" form="addForm" class="btn btn-info" style="color: white;">추가</button>
                </div>
            </div>
        </div>
    </div>
    {{-- /모달 창: 운항정보 추가 --}}

    {{-- 모달 창: 지연 --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">항공편 지연</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.update') }}" method="POST" id="editForm">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col col-3">날짜</div>
                            <div class="col col-6"><span id="delayItemDate"></span></div>
                        </div>
                        <div class="row">
                            <div class="col col-3">편명</div>
                            <div class="col col-6"><span id="delayItemName"></span></div>
                        </div>
                        <div class="row">
                            <div class="col col-3">항공사</div>
                            <div class="col col-6"><span id="delayItemAirline"></span></div>
                        </div>
                        <div class="row">
                            <div class="col col-5 txtCenter"><span id="delayItemDepPort"></span></div>
                            <div class="col arrow"> → </div>
                            <div class="col col-5 txtCenter"><span id="delayItemArrPort"></span></div>
                        </div>
                        <div class="row">
                            <input type="text" class="col" name="depHour" placeholder="시" id="delayItemDepHour">
                            <div class="col col-1 arrow"> : </div>
                            <input type="text" class="col" name="depMin" placeholder="분" id="delayItemDepMin">
                            <div class="col col-1 arrow"> → </div>
                            <input type="text" class="col" name="arrHour" placeholder="시" id="delayItemArrHour">
                            <div class="col col-1 arrow"> : </div>
                            <input type="text" class="col" name="arrMin" placeholder="분" id="delayItemArrMin">
                        </div>
                        <div class="row">
                            <div class="col col-2">사유</div>
                            <input type="text" class="col" name="delayReason" id="delayItemDelayReason" placeholder="지연 사유를 입력해주세요.">
                        </div>
                        <div class="row">
                            <div class="col col-3">예약석</div>
                            <div class="col col-6"><span id="delayItemSeatCount"></span></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="fly_no" id="editFlightId">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">취소</button>
                        <button type="submit" form="editForm" class="btn btn-warning" style="color: white;">지연</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- /모달 창: 지연 --}}

    {{-- 모달 창: 지연사유 보기 --}}
    <div class="modal fade" id="delayReasonViewModal" tabindex="-1" aria-labelledby="delayReasonViewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delayReasonViewModalLabel">항공편 지연사유</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="delayReasonViewBody">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
                </div>
            </div>
        </div>
    </div>
    {{-- /모달 창: 지연사유 보기 --}}
@endsection

@section('js')
    <script src="{{asset('js/admin.js')}}"></script>
@endsection