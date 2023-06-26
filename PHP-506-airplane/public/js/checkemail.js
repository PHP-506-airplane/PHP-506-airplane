let emailButtonClicked = false;

async function chkEmail() {
    const id = document.getElementById('email');
    const div = document.getElementById('testtest');
    const url = "/api/mail?email=" + id.value;

    if (id.value === "") {
        alert("이메일을 입력해주세요.");
        return;
    }

    const emailRegex = /\S+@\S+\.\S+/;
    if (!emailRegex.test(id.value)) {
        alert("올바른 이메일 형식이 아닙니다.");
        return;
    }

    fetch(url, {
        method: 'POST'
    })
    .then(res => {
        if(!res.ok) {
            throw new Error(res.status + ' : API Response Error');
        }
        return res.json();
    }) 
    .then(apiData => {
        // div.innerHTML = apiData['message'];
        alert(apiData['message']);

        // 중복 확인 버튼 클릭 여부 설정
        emailButtonClicked = true;
    })
    .catch(error => alert(error.message));
}

const registForm = document.getElementById('registForm');
function register() {
    if (emailButtonClicked) {
        registForm.submit();
    } else {
        alert('이메일 중복확인이 필요합니다.');
    }
}
