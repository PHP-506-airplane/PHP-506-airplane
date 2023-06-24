function checkPassword() {
    var passwordInput = document.getElementById("nowpassword");
    var passwordStatus = document.getElementById("passwordStatus");
    var password = passwordInput.value;
  
    // 서버에 비밀번호 일치 여부를 요청합니다.
    fetch('/users/chgpw', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ password: password })
    })
    .then(function(response) {
      return response.json();
    })
    .then(function(data) {
      if (data.isValid) {
        passwordStatus.textContent = "비밀번호가 일치합니다.";
      } else {
        passwordStatus.textContent = "비밀번호가 일치하지 않습니다.";
      }
    })
    .catch(function(error) {
      console.error('비밀번호 체크 오류:', error);
    });
  }