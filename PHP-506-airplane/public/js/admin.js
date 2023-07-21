document.getElementById('searchBtn').addEventListener('click', async function () {
    showLoading();
    const dateStart = document.getElementById('dateStart').value;
    const dateEnd = document.getElementById('dateEnd').value;
    const airline = document.getElementById('airline').value;
    const depPort = document.getElementById('depPort').value;
    const arrPort = document.getElementById('arrPort').value;

    const url = `/api/admin/search?dateStart=${dateStart}&dateEnd=${dateEnd}&airline=${airline}&depPort=${depPort}&arrPort=${arrPort}`;

    // Axios로 GET 요청 보내기
    await axios.get(url)
        .then((response) => {
            const data = response.data;
            const resultRow = document.getElementById('resultRow');
            resultRow.innerHTML = ''; // 기존 내용 비우기
            // 페이지네이션 링크 갱신
            const paginateDiv = document.querySelector('.paginate');
            paginateDiv.innerHTML = ''; // 기존 페이지네이션 링크 제거

            if (data.success) {
                const searchData = data.data;

                searchData.data.forEach((item) => {
                    resultRow.innerHTML += `
                        <div class="row">
                            <div class="col">${item.fly_date}</div>
                            <div class="col">${item.line_name}</div>
                            <div class="col">${item.dep_port_name}</div>
                            <div class="col">${item.arr_port_name}</div>
                            <div class="col">${item.dep_time.substring(0, 2)}:${item.dep_time.substring(2)}</div>
                            <div class="col">${item.arr_time.substring(0, 2)}:${item.arr_time.substring(2)}</div>
                            <div class="col">${item.count}석</div>
                            <div class="col">
                                <button type="button" class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#editModal">수정</button>
                                <button type="button" class="btn btn-outline-dark btn-sm">삭제</button>
                            </div>
                        </div>
                        <hr>
                    `;
                });

                searchData.links.forEach((link) => {
                    paginateDiv.innerHTML += `
                        <a class="page-link ${link.active ? 'active' : ''} jsPage" href="${link.url}">${link.label}</a>
                    `;
                });
            } else {
                resultRow.innerHTML = `
                    <div class="row">
                        <div class="col">운항일정이 없습니다.</div>
                    </div>
                    <hr>
                `;
                paginateDiv.innerHTML = '';
                console.log(response.data);
            }
        })
        .catch((err) => {
            alert('에러');
            console.error(err);
        })
        .finally(function() {
            removeLoading();
        });
});