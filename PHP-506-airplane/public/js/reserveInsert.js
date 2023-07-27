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

const insertForm = document.getElementById('insertForm');


// 항공편 pk, 좌석 이름을 보내서 캐시가 있는지 확인
// reservationController의 caching으로 넘어감
async function submitReq() {
    showLoading();
    let seatNo = document.querySelectorAll('.seat_no');
    let flyNo = document.getElementById('fly_no');
    let flg = document.getElementById('flg');
    let seats = [];

    
    seatNo.forEach(function(seat) {
        seats.push(seat.value);
    });
    
    let arrCaching = [];
    let seatSuc = [];
    let seatFail = [];
    let price = 0;
    
    console.log(seats);
    console.log(flyNo.value);
    console.log(flg.value);
    for(let i = 0; i < seats.length; i++) {
        arrCaching.push(await axios.post('/api/reservations/cache', {
            fly_no: flyNo.value,
            seat_no: seats[i]
        }));
        // console.log(arrCaching[i].data);
        if (arrCaching[i].data.success) {
            let price1 = await getPrice(flyNo.value);
            price += price1;
            seatSuc.push([flyNo.value, seats[i]]);
            // let totalPrice = (price1 + price2) * allCnt.value;
            // let cachedData=[];
    
            //     cachedData = [
            //         [flyNo, seats[i]]
            //     ];
                
            // requestPay(totalPrice, cachedData);
        } else {
            seatFail.push([flyNo.value, seats[i]]);
            // removeLoading();
            // alert('이미 진행중인 예약입니다.');
        }
    }

if(flg.value =='1'){
    let seatNo2 = document.querySelectorAll('.seat_no2');
    let flyNo2 = document.getElementById('fly_no2');
    let seats2 = [];

    seatNo2.forEach(function(seat) {
        seats2.push(seat.value);
    });
    console.log(seats2);
    for(let i = 0; i < seats2.length; i++) {
        arrCaching.push(await axios.post('/api/reservations/cache', {
            fly_no: flyNo2.value,
            seat_no: seats2[i]
        }));
        if (arrCaching[i].data.success) {
            let price2 = await getPrice(flyNo2.value);
            price += price2;
            seatSuc.push([flyNo2.value, seats2[i]]);
            // let totalPrice = (price1 + price2) * allCnt.value;
        //     let cachedData=[];
    
        //         cachedData = [
        //             [flyNo, seats[i]]
        //         ];
        //          cachedData = [
        //             [flyNo2, seats2[i]]
        //         ];
        //     requestPay(totalPrice, cachedData);
            
        } 
        else {
            seatFail.push([flyNo2.value, seats2[i]]);
            // removeLoading();
            // alert('이미 진행중인 예약입니다.');
        }
    }
}

    if (seatFail.length > 0 ) {
        removeLoading();
        alert('이미 진행중인 예약입니다.'+seatFail);
    } else {

        requestPay(price, seatSuc);
    }



    // console.log(arrCaching);

    // let allCnt = document.getElementById('allCnt');

    // if (arrCaching.data.success && arrCaching2.data.success) {
    //     let price1 = await getPrice(flyNo);
    //     let price2 = await getPrice(flyNo2);
    //     let totalPrice = (price1 + price2) * allCnt.value;
    //     let cachedData=[];

    //         cachedData = [
    //             [flyNo, seats[i]]
    //         ];
    //          cachedData = [
    //             [flyNo2, seats2[i]]
    //         ];
    //     requestPay(totalPrice, cachedData);
    // } else {
    //     removeLoading();
    //     alert('이미 진행중인 예약입니다.');
    // }
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

// async function submitReq() {
//     let seatNo = document.querySelectorAll('.seat_no');
//     let seatNo2 = document.querySelectorAll('.seat_no2');
//     let flyNo = document.getElementById('fly_no');
//     let flyNo2 = document.getElementById('fly_no2');

//     let seats = [];
//     let seats2 = [];

//     seatNo.forEach(function(seat) {
//         seats.push(seat.value);
//     });

//     seatNo2.forEach(function(seat) {
//         seats2.push(seat.value);
//     });

//     console.log(seats);
//     console.log(seats2);

//     // 중복된 좌석을 추적하기 위한 플래그 변수와 중복된 좌석 정보를 담을 배열을 생성.
//     let isDuplicate = false;
//     let duplicateSeats = [];
//     for (let i = 0; i < seats.length; i++) {
//         if (seats.indexOf(seats[i]) !== i) {
//             // 중복된 좌석이 발견되면 해당 좌석을 duplicateSeats 배열에 추가하고 플래그 변수를 true로 설정.
//             if (!duplicateSeats.includes(seats[i])) {
//                 duplicateSeats.push(seats[i]);
//             }
//             isDuplicate = true;
//         }
//     }

//     for (let i = 0; i < seats2.length; i++) {
//         if (seats2.indexOf(seats2[i]) !== i) {
//             if (!duplicateSeats.includes(seats2[i])) {
//                 duplicateSeats.push(seats2[i]);
//             }
//             isDuplicate = true;
//         }
//     }

//     if (isDuplicate) {
//         removeLoading();
//         alert('선택한 좌석 중에 중복된 좌석이 있습니다.');
//         return;
//     }

//     console.log(arrCaching);

//     let allCnt = document.getElementById('allCnt');

//     if (arrCaching.data.success && arrCaching2.data.success) {
//         let price1 = await getPrice(flyNo);
//         let price2 = await getPrice(flyNo2);
//         let totalPrice = (price1 + price2) * allCnt.value;
//         let cachedData = [];

//         cachedData = [
//             [flyNo, seats[i]]
//         ];
//         cachedData = [
//             [flyNo2, seats2[i]]
//         ];
//         requestPay(totalPrice, cachedData);
//     } else {
//         removeLoading();
//         alert('이미 진행중인 예약입니다.');
//     }
// }


async function clearResCache(cachedData) {
    cachedData.forEach(async (data) => {
        // console.log('캐시클리어데이터'+data);
        data.forEach(
            function(aa) {
                console.log('클리어데이터 : ' + aa);
            }
        );
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


