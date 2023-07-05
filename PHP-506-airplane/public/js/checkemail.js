let emailButtonClicked = false; //초기값으로 false줌(중복 확인 버튼이 눌러졌는지 확인하기 위해서)

async function chkEmail2() {
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
        method: 'POST'  //생성된 url을 post로(이메일 중복확인 요청)
    })
    .then(res => {
        if(!res.ok) {
            throw new Error(res.status + ' : API Response Error');
        }
        return res.json(); //응답 데이터를 json형태로
    }) 
    .then(apiData => {
        // div.innerHTML = apiData['message'];
        alert(apiData['message']);

        // 중복 확인 버튼 클릭 여부 설정, 중복 버튼이 클릭되었는지 확인
        emailButtonClicked = true;
    })
    .catch(error => alert(error.message));
}

const emailInput = document.getElementById('email');

function clickedFalse() {
    emailButtonClicked = false;
}

const registForm = document.getElementById('registForm');
function register() {
    if (emailButtonClicked) {
        registForm.submit();
    } else {
        alert('이메일 중복확인이 필요합니다.');
    }
}
