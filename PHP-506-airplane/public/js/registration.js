const chkNameMsg = document.getElementById('chk_name_msg');
const chkEmailMsg = document.getElementById('chk_email_msg');
const chkBirthMsg = document.getElementById('chk_birth_msg');

function chkName() {
    const p1 = document.getElementById('name');
    const p2 = /^[가-힣]{2,30}$/u;

    if(p2.test(p1.value)===false) {
        chkNameMsg.style.color = 'red'
        chkNameMsg.innerHTML = '❕이름은 한글 2~30글자 사이로 입력해주세요.'
    }
    else {
        chkNameMsg.style.color = 'green';
        chkNameMsg.innerHTML = '✔️사용가능한 이름입니다.';
    }
}


function chkEmail() {
    const p3 = document.getElementById('email');
    const p4 = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;

    if(p4.test(p3.value)===false) {
        chkEmailMsg.style.color = 'red'
        chkEmailMsg.innerHTML = '❕올바른 이메일 형식이 아닙니다.'
    }
    else {
        chkEmailMsg.style.color = 'green';
        chkEmailMsg.innerHTML = '✔️이메일 중복 확인을 해주세요.';
    }
}

function chkBirth() {
    const p5 = document.getElementById('u_birth');
    const p6 = document.getElementById('chk_birth_msg');
	const now = new Date();
	const birthDay = new Date(p5.value);
    let age = 0;

	// age = now.getFullYear() - birthDay.getFullYear();
	
	// if(now.getTime() < birthDay.getFullYear()) {
    //     age--;
    // }
	// // 만나이를 떄문에 조건을 건다
	// if(age<15) {
    //     p6.innerHTML = '만 14세 이상만 가입이 가능합니다.';
    //     p6.style.color = 'red';
    // } else {
    //     p6.innerHTML = '가입이 가능한 나이입니다.';
    //     p6.style.color = 'green';
    // }
    age = now.getFullYear() - birthDay.getFullYear();
    const m = now.getMonth() - birthDay.getMonth();
    if (m < 0 || (m === 0 && now.getDate() < birthDay.getDate())) {
        age--;
    }

    if(age<14) {
        p6.innerHTML = '❕만 14세 이상만 가입이 가능합니다.';
        p6.style.color = 'red';
    } else {
        p6.innerHTML = '✔️가입이 가능한 나이입니다.';
        p6.style.color = 'green';
    }
}