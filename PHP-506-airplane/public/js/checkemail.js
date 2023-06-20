function chkEmail() {
    const id = document.getElementById('email');
    const div = document.getElementById('testtest');
    const url = "?mail=" + id.value;

    fetch(url, {
        headers : {
            "X-Requested-With" : "XMLHttpRequest" 
        }
    })
    .then(data => {
        if(!data.ok) {
            throw new Error(data.status + ' : API Response Error');
        }
        return data.json();
    }) 
    .then(data => {
        // if(apiData["flg"] === "1") {
        //     alert(apiData["message"]);
        // } else {
            // alert(apiData["message"]);
        // }
        // let formattedData = '';
        // Object.entries(data).forEach(([key, val]) => {
        //     formattedData += `${key}: ${val}<br>`;
        // });
        // if (data.data) {
        //     Object.entries(data.data).forEach(([key, value]) => {
        //         formattedData += ` - ${key}: ${value}<br>`;
        //     });
        // }
        // div.innerHTML = data;
    })

    .catch(error => alert(error.message));
}