// 가격 가져오는 api
async function getPrice(pk) {
    try {
        // const res = await axios.post('/api/pay/price', { pk: pk });
        const res = await axios.get('/api/pay/price/' + pk);
        const price = await res.data.price;
        // 좌석수 추가
        
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
let dep_name = document.querySelectorAll('.seat_input');
let arr_name = document.querySelectorAll('.seat_input2');
// 예약확정 confirm
const seatForm = document.getElementById('insertInfo');
async function reserveBtn(){
    let fly_no = document.getElementById('fly_no').value;

    if (flg.value == 1) {
        let fly_no2 = document.getElementById('fly_no2').value;
            showLoading();
            try {
                // 중복 확인을 위해 API 호출
                for(let i=0; i < dep_name.length; i++){
                    let isDuplicate = [];
                    isDuplicate[i] = await checkDupRes(fly_no, dep_name[i].value);

                    let asDuplicate=[]; 
                    asDuplicate[i] = await checkDupRes(fly_no2, arr_name[i].value);
                
                let alertMsg = '이미 예약된 좌석입니다. : ';
                if (isDuplicate[i]) {
                    alertMsg += '\n가는편, ' + dep_name[i].value;
                }
                if (asDuplicate[i]) {
                    alertMsg += '\n오는편, ' + arr_name[i].value;
                }

                if (isDuplicate[i] || asDuplicate[i]) {
                    alert(alertMsg);
                    removeLoading();
                } else {
                    let caching = [];
                    caching[i]= await axios.post('/api/reservations/cache', {
                        fly_no: fly_no,
                        seat_no: dep_name[i].value
                    });

                    let cachings = [];
                    cachings[i]= await axios.post('/api/reservations/cache', {
                        fly_no: fly_no2,
                        seat_no: arr_name[i].value
                    });

                    if (caching[i].data.success && cachings[i].data.success) {
                        let price1 = await getPrice(fly_no);
                        let price2 = await getPrice(fly_no2);
                        let totalPrice = price1 + price2;
                        let cachedData= []; 
                        cachedData[i]= [
                            [fly_no, dep_name[i].value],
                            [fly_no2, arr_name[i].value]
                        ];
                        requestPay(totalPrice, cachedData);
                    } else {
                        removeLoading();
                        alert('이미 진행중인 예약입니다.');
                    }
                }
            }
            } catch (error) {
                console.log(error);
                removeLoading();
            }
        
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
                        let cachedData = [
                            [fly_no, s_name.value]
                        ];
                        requestPay(totalPrice, cachedData);
                    } else {
                        removeLoading();
                        alert('이미 진행중인 예약입니다.\n' + caching.data.msg);
                    }
                }
            } catch (error) {
                removeLoading();
                console.log(error);
            }
        
    }
}
