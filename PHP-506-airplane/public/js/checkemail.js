function chkEmail() {
    const id = document.getElementById('email');

    const url = "/api/user?email=" + email.value;
    let apiData = null;

    fetch(url)
    .then(data => {
        if(data.status !== 200) {
            throw new Error(data.status + ' : API Response Error');
        }
            return data.json();
        }) 
    .then(apiData => {
        const emailbnt = document.getElementById('errMsgemail');
        if(apiData["flg"] === "1") {
            emailbnt.innerHTML = apiData["msg"];
        } else {
            emailbnt.innerHTML = "";
        }
    })

    .catch(error => alert(error.message));
}