// 좌석 배열
let seats = [
    ['A1', 'A2', 'A3', 'A4', 'A5']
    ,['B1', 'B2', 'B3', 'B4', 'B5']
    ,['C1', 'C2', 'C3', 'C4', 'C5']
    ,['D1', 'D2', 'D3', 'D4', 'D5']
    ,['E1', 'E2', 'E3', 'E4', 'E5']
];

// 예약된 좌석 배열
let reservedSeats = [];

// 좌석 선택 함수
function selectSeat(seat) {
    // 이미 예약된 좌석인지 확인
    if (reservedSeats.includes(seat)) {
        console.log('이미 예약된 좌석입니다.');
    } else {
        // 예약된 좌석이 아닌 경우, 좌석을 예약하고 예약된 좌석 배열에 추가
        reservedSeats.push(seat);
        console.log('좌석 ' + seat + '이(가) 예약되었습니다.');
    }
}

// 예약된 좌석 표시 함수
function showReservedSeats() {
    console.log('예약된 좌석 목록:');
    console.log(reservedSeats);
}

// 좌석 선택 ex
selectSeat('A3');
selectSeat('B2');
selectSeat('C4');
selectSeat('A3');
selectSeat('D1');
selectSeat('E5');

// 예약된 좌석 목록 출력
showReservedSeats();
