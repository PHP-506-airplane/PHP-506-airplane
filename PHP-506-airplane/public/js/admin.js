const deleteButtons = document.querySelectorAll('.delete-btn');
const deleteForm    = document.getElementById('deleteForm');
const itemName      = document.getElementById('itemName');
const itemDate      = document.getElementById('itemDate');
const itemAirline   = document.getElementById('itemAirline');
const itemDepPort   = document.getElementById('itemDepPort');
const itemArrPort   = document.getElementById('itemArrPort');
const itemDepTime   = document.getElementById('itemDepTime');
const itemArrTime   = document.getElementById('itemArrTime');
const itemSeatCount = document.getElementById('itemSeatCount');
const flightIdInput = document.getElementById('flightId');

function setModalData(date, name, airline, depPort, arrPort, depTime, arrTime, seatCount, flightId) {
    itemDate.textContent        = date;
    itemName.textContent        = name;
    itemAirline.textContent     = airline;
    itemDepPort.textContent     = depPort;
    itemArrPort.textContent     = arrPort;
    itemDepTime.textContent     = depTime;
    itemArrTime.textContent     = arrTime;
    itemSeatCount.textContent   = seatCount;
    flightIdInput.value         = flightId;
}

function clearModalData() {
    itemName.textContent        = '';
    itemDate.textContent        = '';
    itemAirline.textContent     = '';
    itemDepPort.textContent     = '';
    itemArrPort.textContent     = '';
    itemDepTime.textContent     = '';
    itemArrTime.textContent     = '';
    itemSeatCount.textContent   = '';
    flightIdInput.value         = '';
}

const delBtn = document.getElementById('delBtn');

delBtn.addEventListener('click', function() {
    let reason = prompt('결항 사유를 입력해주세요.');
    if (reason) {
        const formData = new FormData(deleteForm);
        // 결항 사유를 폼에 추가
        formData.append('del_reason', reason);
        showLoading();
        
        axios.post(deleteForm.action, formData)
        .then(res => {
                if (res.data.success) {
                    alert(res.data.message);
                    location.reload();
                } else {
                    console.log(res);
                    alert('처리 실패.\n잠시후 다시 시도해주세요.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('처리 실패.\n네트워크 오류가 발생했습니다.'); // 네트워크 오류 시 메시지 출력
            })
            .finally(
                removeLoading()
            );
    } else {
        removeLoading();
        alert('결항 취소.');
    }
});

const input = document.getElementById('price');
input.addEventListener('keydown', function(e) {
    let value = e.target.value;
    value = Number(value.replaceAll(',', ''));
    if(isNaN(value)) {
        input.value = 0;
    }else {
        const formatValue = value.toLocaleString('ko-KR');
        input.value = formatValue;
    }
})

const editModalDate         = document.getElementById('delayItemDate');
const editModalFlightNum    = document.getElementById('delayItemName');
const editModalAirline      = document.getElementById('delayItemAirline');
const editModalDepPort      = document.getElementById('delayItemDepPort');
const editModalArrPort      = document.getElementById('delayItemArrPort');
const editModalDepHour      = document.getElementById('delayItemDepHour');
const editModalDepMin       = document.getElementById('delayItemDepMin');
const editModalArrHour      = document.getElementById('delayItemArrHour');
const editModalArrMin       = document.getElementById('delayItemArrMin');
const editModalSeatCount    = document.getElementById('delayItemSeatCount');
const editFlightId          = document.getElementById('editFlightId');

// 지연 버튼 클릭 시 모달에 데이터를 설정
function setEditModalData(date, name, airline, depPort, arrPort, depTime, arrTime, seatCount, flightId) {
    editModalDate.textContent       = date;
    editModalFlightNum.textContent  = name;
    editModalAirline.textContent    = airline;
    editModalDepPort.textContent    = depPort;
    editModalArrPort.textContent    = arrPort;
    editModalDepHour.value          = depTime.substr(0, 2);
    editModalDepMin.value           = depTime.substr(3, 4);
    editModalArrHour.value          = arrTime.substr(0, 2);
    editModalArrMin.value           = arrTime.substr(3, 4);
    editModalSeatCount.textContent  = seatCount;
    editFlightId.value              = flightId;
}

// 지연사유 모달
function showDelayReasons(delayReasons) {
    let reasonsArray = JSON.parse(delayReasons);
    let modalBody = document.getElementById('delayReasonViewBody');
    modalBody.innerHTML = ''; // 기존 내용 초기화

    reasonsArray.forEach(function(reason, index) {
        let reasonString = '';
        for (let key in reason) {
            reasonString += key + ' : ' + reason[key];
        }
        modalBody.innerHTML += '<div class="row">' + (index + 1) + '. ' + reasonString.slice(0, 11) + ' / ' + reasonString.slice(11, 20) + '<p class="spanDelayReason">' + reasonString.slice(21) + '</p></div>';
    });

    // 지연사유 보기 모달 열기
    let delayReasonViewModal = new bootstrap.Modal(document.getElementById('delayReasonViewModal'), {});
    delayReasonViewModal.show();
}