let seats = document.querySelectorAll('.fast a');
let seats2 = document.querySelectorAll('.fast2 a');
let s_name = document.querySelector('.show_name');
let s_name2 = document.querySelector('.show_name2');
let choice = document.querySelector('.tab');

// 가는편 좌석 선택
seats.forEach(function (seat) {
    seat.addEventListener('click', function () {
        seats.forEach(function (seat) {
            seat.classList.remove('selected');
        });
        seat.classList.toggle('selected');
        s_name.value = seat.querySelector('#s_name').value;
    });
});

// 오는편 좌석 선택
seats2.forEach(function (seat) {
    seat.addEventListener('click', function () {
        seats2.forEach(function (seat) {
            seat.classList.remove('selected');
        });
        seat.classList.toggle('selected');
        s_name2.value = seat.querySelector('#s_name2').value;
    });
});

// 가는편/오는편 탭
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
        const response = await axios.get(`/api/reservations/duplicate-check/${fly_no}/${seat_no}`);
        const data = response.data;
        return data.is_duplicate;
    } catch (error) {
        console.log(error);
        throw error;
    }
}

const flg = document.querySelector('.flg');
// 예약확정 confirm
const seatForm = document.getElementById('seatPost');
async function reserveBtn(){
    let fly_no = document.getElementById('fly_no').value;
    let fly_no2 = document.getElementById('fly_no2').value;

    if (flg.value == 1) {
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
                } else {
                    let data1 = {
                        fly_no: fly_no
                        ,seat_no: s_name.value
                    }

                    let data2 = {
                        fly_no: fly_no2
                        ,seat_no: s_name2.value
                    }

                    let caching = await axios.post('/api/reservations/cache', data1);
                    let caching2 = await axios.post('/api/reservations/cache', data2);

                    if (caching.data.success && caching2.data.success) {
                        let price1 = await getPrice(fly_no);
                        let price2 = await getPrice(fly_no2);
                        let totalPrice = price1 + price2;
                        requestPay(totalPrice);
                    } else {
                        removeLoading();
                        alert('이미 진행중인 예약입니다.');
                    }
                }
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
                    let data = {
                        fly_no: fly_no
                        ,seat_no: s_name.value
                    }
                    let caching = await axios.post('/api/reservations/cache', data);

                    if (caching.data.success) {
                        let totalPrice = await getPrice(fly_no);
                        requestPay(totalPrice);
                    } else {
                        removeLoading();
                        alert('이미 진행중인 예약입니다.\n' + caching.data.msg);
                    }
                }
            } catch (error) {
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