const deleteButtons = document.querySelectorAll('.delete-btn');
const deleteForm = document.getElementById('deleteForm');
const itemName = document.getElementById('itemName');
const itemDate = document.getElementById('itemDate');
const itemAirline = document.getElementById('itemAirline');
const itemDepPort = document.getElementById('itemDepPort');
const itemArrPort = document.getElementById('itemArrPort');
const itemDepTime = document.getElementById('itemDepTime');
const itemArrTime = document.getElementById('itemArrTime');
const itemSeatCount = document.getElementById('itemSeatCount');
const flightIdInput = document.getElementById('flightId');

function setModalData(date, name, airline, depPort, arrPort, depTime, arrTime, seatCount, flightId) {
    itemDate.textContent = date;
    itemName.textContent = name;
    itemAirline.textContent = airline;
    itemDepPort.textContent = depPort;
    itemArrPort.textContent = arrPort;
    itemDepTime.textContent = depTime;
    itemArrTime.textContent = arrTime;
    itemSeatCount.textContent = seatCount;
    flightIdInput.value = flightId;
}

function clearModalData() {
    itemName.textContent = '';
    itemDate.textContent = '';
    itemAirline.textContent = '';
    itemDepPort.textContent = '';
    itemArrPort.textContent = '';
    itemDepTime.textContent = '';
    itemArrTime.textContent = '';
    itemSeatCount.textContent = '';
    flightIdInput.value = '';
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
                    alert('삭제 실패.\n잠시후 다시 시도해주세요.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('삭제 실패.\n네트워크 오류가 발생했습니다.'); // 네트워크 오류 시 메시지 출력
            })
            .finally(
                removeLoading()
            );
    } else {
        removeLoading();
        alert('결항 취소.');
    }
});