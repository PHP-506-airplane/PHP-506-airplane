async function chkEmail() {
    const id = document.getElementById('email');
    const div = document.getElementById('testtest');
    const url = "/api/mail?email=" + id.value;

    if (id.value === "") {
        alert("이메일을 입력해주세요.");
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
    })
    .catch(error => alert(error.message));
}