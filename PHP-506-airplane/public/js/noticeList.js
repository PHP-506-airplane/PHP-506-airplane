const searchButton = document.querySelector('button[type="button"]');
const searchInput = document.getElementById('serachInput');

searchButton.addEventListener('click', () => {
    const searchText = searchInput.value.trim().toLowerCase();
    const items = document.getElementsByClassName('mainContents');

    // 제목을 검색어랑 비교해서 필터링
    for(let i = 0; i < items.length; i++) {
        const itemTitle = items[i].querySelector('a').innerText.toLowerCase();

        if(itemTitle.includes(searchText)) {
            items[i].style.display = 'block';
        } else {
            items[i].style.display = 'none';
        }
    }
});

// 페이지네이션
const paginateLinks = document.getElementsByClassName('page-link');
const itemList = document.getElementsByClassName('mainContents');
const itemsPerPage = 10;

for(let i = 0; i < paginateLinks.length; i++) {
    paginateLinks[i].addEventListener('click', (e) => {
        e.preventDefault();
        const targetPage = e.target.getAttribute('data-page');

        // 각 페이지에 해당하는 항목만 표시
        for(let j = 0; j < itemList.length; j++) {
            if((j >= (targetPage - 1) * itemsPerPage) && (j < targetPage * itemsPerPage)) {
                itemList[j].style.display = 'block';
            } else {
                itemList[j].style.display = 'none';
            }
        }
    });
}
