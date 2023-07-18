let type = document.getElementById('type').getAttribute('data-type');
let idTab = document.getElementById('idTab');
let pwTab = document.getElementById('pwTab');
let idContent = document.getElementById('idContent');
let pwContent = document.getElementById('pwContent');

if (type === 'id') {
    pwContent.classList.add('hideTab');
} else {
    idContent.classList.add('hideTab');
}

idTab.addEventListener('click', function() {
    idContent.classList.remove('hideTab');
    pwContent.classList.add('hideTab');
});

pwTab.addEventListener('click', function() {
    idContent.classList.add('hideTab');
    pwContent.classList.remove('hideTab');
});

// 이메일 찾기
const emailFindBtn = document.getElementById('emailFindButton');
let btnClicked = false; // 버튼 클릭 여부 플래그
emailFindBtn.addEventListener('click', function() {
    // 쓰로틀링
    // emailFindBtn.disabled = true;
    // 버튼이 이미 클릭된 경우, 중복 클릭을 막음
    if (btnClicked) {
        return;
    }
    showLoading();

    // 버튼 클릭 상태로 설정 ()
    btnClicked = true;

    let form = document.getElementById('emailFindForm');
    let formData = new FormData(form);

    axios.post('/api/users/email', formData)
        .then(function(res) {
            let resultSpan = document.getElementById('resultSpan');
            let result = res.data;
            resultSpan.innerText = result.msg;
            resultSpan.style.color = result.color;

            let loginLink = document.createElement('a');
            loginLink.href = "{{ route('users.login') }}";
            loginLink.textContent = '로그인 페이지로 이동';
            loginLink.classList.add('aPoint');
    
            resultSpan.appendChild(document.createElement('br'));
            resultSpan.appendChild(loginLink);
        })
        .catch(function(error) {
            alert('잠시 후 다시 시도해주세요.');
            console.error(error);
        })
        .finally(function() {
            // 1초 후에 쓰로틀링 해제
            setTimeout(function() {
                btnClicked = false;
            }, 1000);
            removeLoading();
        });
});

// 비밀번호 찾기
const pwFindBtn = document.getElementById('pwFindButton');
let pwBtnClicked = false; // 버튼 클릭 여부 플래그
pwFindBtn.addEventListener('click', function() {
    // 쓰로틀링
    if (pwBtnClicked) {
        return;
    }
    showLoading();

    // 버튼 클릭 상태로 설정 ()
    pwBtnClicked = true;

    let form = document.getElementById('pwFindForm');
    let formData = new FormData(form);

    axios.post('/api/users/password', formData)
        .then(function(res) {
            let result = res.data;
            alert(result.msg);
            location.href="/users/login"
        })
        .catch(function(error) {
            alert('잠시 후 다시 시도해주세요.');
            console.error(error);
        })
        .finally(function() {
            removeLoading();
            // 1초 후에 쓰로틀링 해제
            setTimeout(function() {
                pwBtnClicked = false;
            }, 1000);
        });
});