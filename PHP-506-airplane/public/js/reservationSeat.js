let seats = document.querySelectorAll('.fast a');
let seats2 = document.querySelectorAll('.fast2 a');
let s_name = document.querySelector('.show_name');
let s_name2 = document.querySelector('.show_name2');
let choice = document.querySelector('.tab');
let nextbtn = document.querySelector('.chk_btn');
// 인원수 입력란 가져오기
let peoNum = document.getElementById('peoNum').getAttribute('peoNums');

// 선택한 좌석들을 저장할 배열
let selectedSeats = [];
let selectedSeats2 = [];
const divtest = document.getElementById('test');


function test() {
    // 인원수에 맞게 선택한 좌석들의 정보를 출력
    for (let i = 0; i < selectedSeats.length; i++) {
        const seat = selectedSeats[i];
        let name = seat.querySelector('#s_name').value;
        document.getElementById(`show_name${i}`).value = name;
    }
}
function testCancel() {
    // 선택이 해제된 좌석들의 정보를 삭제 (show_name 입력란 값을 빈 문자열로 설정)
    for (let i = selectedSeats.length; i >= 0; i--) {
        document.getElementById(`show_name${i}`).value = "";
        break;
    }
}


function test2() {
    // 인원수에 맞게 선택한 좌석들의 정보를 출력
    for (let i = 0; i < selectedSeats2.length; i++) {
        const seat = selectedSeats2[i];
        let name = seat.querySelector('#s_name2').value;
        document.getElementById(`show_name2${i}`).value = name;
    }
}
function testCancel2() {
    // 선택이 해제된 좌석들의 정보를 삭제 (show_name 입력란 값을 빈 문자열로 설정)
    for (let i = selectedSeats2.length; i >= 0; i--) {
        document.getElementById(`show_name2${i}`).value = "";
        break;
    }
}



// 가는편 좌석 선택
seats.forEach(function (seat) {
    seat.addEventListener('click', function () {
        // 이미 인원수 만큼 좌석이 선택된 경우, 추가 선택을 막음
        if (selectedSeats.length >= peoNum && !selectedSeats.includes(seat)) {
            return;
        }
        // 좌석 선택 또는 해제
        if (selectedSeats.includes(seat)) {
            seat.classList.remove('selected');
            selectedSeats = selectedSeats.filter((item) => item !== seat);
            testCancel();
        } else {
            seat.classList.add('selected');
            selectedSeats.push(seat);
            test();
        }

        // 선택한 좌석이 인원수를 초과하는 경우, 가장 처음 선택한 좌석 선택 해제
        while (selectedSeats.length > peoNum) {
            let firstSelectedSeat = selectedSeats.shift();
            firstSelectedSeat.classList.remove('selected');
        } 
    });
});


// 오는편 좌석 선택
seats2.forEach(function (seat) {
    seat.addEventListener('click', function () {
        // 이미 인원수 만큼 좌석이 선택된 경우, 추가 선택을 막음
        if (selectedSeats2.length >= peoNum && !selectedSeats2.includes(seat)) {
            return;
        }

        // 좌석 선택 또는 해제
        if (selectedSeats2.includes(seat)) {
            seat.classList.remove('selected');
            selectedSeats2 = selectedSeats2.filter((item) => item !== seat);
            testCancel2();
        } else {
            seat.classList.add('selected');
            selectedSeats2.push(seat);
        }

        test2();
        // s_name2.value = seat.querySelector('#s_name').value;

        // 선택한 좌석이 인원수를 초과하는 경우, 가장 처음 선택한 좌석 선택 해제
        while (selectedSeats2.length > peoNum) {
            let firstSelectedSeat = selectedSeats2.shift();
            firstSelectedSeat.classList.remove('selected');
        }

        // if(selectedSeats.length < peoNum && !selectedSeats.includes(seat)) {
        //     alert('인원수에 맞게 좌석수를 선택해주세요.');
        //     return;
        // }
    });
});

// // 가는편/오는편 탭
function changeTab(tabId) {
    var tabId1 = document.getElementById('aFlight1');
    var tabId2 = document.getElementById('aFlight2');
    var map = document.getElementsByClassName('map');

    if (tabId == 'aFlight1') {
        tabId1.parentElement.classList.add('choice');
        tabId2.parentElement.classList.remove('choice');
        map[0].classList.add('active');
        map[1].classList.remove('active');
    } else {
        tabId2.parentElement.classList.add('choice');
        tabId1.parentElement.classList.remove('choice');
        map[1].classList.add('active');
        map[0].classList.remove('active');
    }
}

// 중복확인 api
async function checkDupRes(fly_no, seat_no) {
    try {
        const res = await axios.get(`/api/reservations/duplicate-check/${fly_no}/${seat_no}`);
        const data = res.data;
        return data.is_duplicate;
    } catch (err) {
        console.log(err);
        throw err;
    }
}

const flg = document.querySelector('.flg');
// 예약확정 confirm
const seatForm = document.getElementById('seatPost');
async function reserveBtn(){
    let fly_no = document.getElementById('fly_no').value;

    if (flg.value == 1) {
        let fly_no2 = document.getElementById('fly_no2').value;
        if (s_name.value == '') {
            alert('가는편 좌석을 선택해 주세요.');
        }
        else if (s_name2.value == '') {
            alert('오는편 좌석을 선택해 주세요.');
        } else {
            showLoading();
            // seatForm.submit();
            try {
                // 중복 확인을 위해 API 호출
                let isDuplicate1 = await checkDupRes(fly_no, s_name.value);
                let isDuplicate2 = await checkDupRes(fly_no2, s_name2.value);
                let alertMsg = '이미 예약된 좌석입니다. : ';
                if (isDuplicate1) {
                    alertMsg += '\n가는편, ' + s_name.value;
                }
                if (isDuplicate2) {
                    alertMsg += '\n오는편, ' + s_name2.value;
                }

                if (isDuplicate1 || isDuplicate2) {
                    alert(alertMsg);
                    removeLoading();
                } 

                seatForm.submit();

            } catch (error) {
                console.log(error);
                removeLoading();
            }
        }
    } else {
        if (s_name.value == '') {
            alert('좌석을 선택해 주세요.');
        } else {
            showLoading();
            // seatForm.submit();
            try {
                let isDuplicate = await checkDupRes(fly_no, s_name.value);
                if (isDuplicate) {
                    alert('이미 예약된 좌석입니다.');
                    removeLoading();
                } else {
                    seatForm.submit();
                }
            } catch (error) {
                removeLoading();
                console.log(error);
            }
        }
    }
}

// 가격 가져오는 api
async function getPrice(pk) {
    try {
        // const res = await axios.post('/api/pay/price', { pk: pk });
        const res = await axios.get('/api/pay/price/' + pk);
        const price = await res.data.price;
        return price;
    } catch (error) {
        console.log(error);
        throw error;
    }
}

// 캐시 지우기
async function clearResCache(cachedData) {
    cachedData.forEach(async (data) => {
        try {
            await axios.post('/api/reservations/clearCache', {
                fly_no: data[0],
                seat_no: data[1]
            });
        } catch (error) {
            console.log(error);
        }
    });
}