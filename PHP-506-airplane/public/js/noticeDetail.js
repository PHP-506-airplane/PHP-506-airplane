const formDel = document.getElementById('formDel');

function confirmDel() {
    let con = confirm("정말 삭제하시겠습니까?");

    if(con === true) {
        formDel.submit();
    }
}