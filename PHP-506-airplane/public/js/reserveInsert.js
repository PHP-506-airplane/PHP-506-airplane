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




//항공편 pk, 좌석 이름을 보내서 캐시가 있는지 확인
//reservationController의 caching으로 넘어감
async function submitReq() {

    let seatNo = document.querySelectorAll('.seat_no');
    let seatNo2 = document.querySelectorAll('.seat_no2');
    let flyNo = document.getElementById('fly_no');
    let flyNo2 = document.getElementById('fly_no2');

    let seats = [];
    let seats2 = [];

    seatNo.forEach(function(seat) {
        seats.push(seat.value);
    });

    seatNo2.forEach(function(seat) {
        seats2.push(seat.value);
    });

    console.log(seats);
    console.log(seats2);

    let arrCaching = [];
    let arrCaching2 = [];

    for(let i = 0; i < seats.length; i++) {
        arrCaching.push(await axios.post('/api/reservations/cache', {
            fly_no: flyNo.value,
            seat_no: seats[i]
        }));
        if (arrCaching[i].data.success) {
            let price1 = await getPrice(flyNo);
            let totalPrice = (price1 + price2) * allCnt.value;
            let cachedData=[];
    
                cachedData = [
                    [flyNo, seats[i]]
                ];
                
            requestPay(totalPrice, cachedData);
        } else {
            removeLoading();
            alert('이미 진행중인 예약입니다.');
        }
    }

    for(let i = 0; i < seats2.length; i++) {
        arrCaching2.push(await axios.post('/api/reservations/cache', {
            fly_no: flyNo2.value,
            seat_no: seats2[i]
        }));
        if (arrCaching2[i].data.success) {
            let price2 = await getPrice(flyNo2);
            let totalPrice = (price1 + price2) * allCnt.value;
            let cachedData=[];
    
                cachedData = [
                    [flyNo, seats[i]]
                ];
                 cachedData = [
                    [flyNo2, seats2[i]]
                ];
            requestPay(totalPrice, cachedData);
        } else {
            removeLoading();
            alert('이미 진행중인 예약입니다.');
        }
    }



    console.log(arrCaching);

    let allCnt = document.getElementById('allCnt');

    if (arrCaching.data.success && arrCaching2.data.success) {
        let price1 = await getPrice(flyNo);
        let price2 = await getPrice(flyNo2);
        let totalPrice = (price1 + price2) * allCnt.value;
        let cachedData=[];

            cachedData = [
                [flyNo, seats[i]]
            ];
             cachedData = [
                [flyNo2, seats2[i]]
            ];
        requestPay(totalPrice, cachedData);
    } else {
        removeLoading();
        alert('이미 진행중인 예약입니다.');
    }
    // let caching2 = await axios.post('/api/reservations/cache', {
    //     fly_no: fly_no2,
    //     seat_no: s_name2.value
    // });

    // if (caching.data.success && caching2.data.success) {
    //     let price1 = await getPrice(fly_no);
    //     let price2 = await getPrice(fly_no2);
    //     let totalPrice = price1 + price2;
    //     let cachedData = [
    //         [fly_no, s_name.value],
    //         [fly_no2, s_name2.value]
    //     ];
    //     requestPay(totalPrice, cachedData);
    // } else {
    //     removeLoading();
    //     alert('이미 진행중인 예약입니다.');
    // }
}