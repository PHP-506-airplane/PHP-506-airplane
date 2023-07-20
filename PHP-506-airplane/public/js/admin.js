let btnClicked = false;
        
document.getElementById('searchBtn').addEventListener('click', function() {
    let form = document.getElementById('searchForm');
    let formData = new FormData(form);

    if (btnClicked) {
        return;
    }

    btnClicked = true
    axios.post('/api/admin/search', formData)
        .then(function(res) {
            if (res.data.success) {
                console.log(res);
                // 받아온 JSON 처리
                let data = res.data.data;
                let outputHtml = '';
                data.forEach(item => {
                    outputHtml += '<div class="row">';
                    outputHtml += '<div class="col">';
                    outputHtml += '날짜 : ' + item.fly_date ;
                    outputHtml += '</div>';
                    outputHtml += '<div class="col">';
                    outputHtml += '가격 : ' + item.price;
                    outputHtml += '</div>';
                    outputHtml += '<div class="col">';
                    outputHtml += '출발 : ' + item.dep_port_no;
                    outputHtml += '</div>';
                    outputHtml += '<div class="col">';
                    outputHtml += '도착 : ' + item.arr_port_no;
                    // outputHtml += '</div>';
                    outputHtml += '</div>';
                });
                document.getElementById('resultDiv').innerHTML = outputHtml;
            } else {
                alert('해당하는 데이터가 없습니다.');
                console.log(res);
            }
        })
        .catch(function(error) {
            alert('검색 요청 실패.');
            console.error(error);
        })
        .finally(function() {
            // 1초 후에 쓰로틀링 해제
            setTimeout(function() {
                btnClicked = false;
            }, 1000);
    });
});