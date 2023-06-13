const outBtn = document.getElementById('out_button');

outBtn.addEventListener('click', () => {
    const confirmation = confirm('탈퇴 하시겠습니까?');

    if(confirmation) {
        document.getElementById('modal_form').submit();
    }
});

const cancleBtn = document.getElementById('cancle_btn');

cancleBtn.addEventListener('click', () => {
    location.href = '/reservation/main/';
});