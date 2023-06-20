async function chkEmail() {
    const id = document.getElementById('email');
    const div = document.getElementById('testtest');
    // const url = "/api/mail?" + id.value;
    const url = "/api/mail";

    fetch(url)
    .then(res => {
        if(!res.ok) {
            throw new Error(res.status + ' : API Response Error');
        }
        return res;
    }) 
    // .then(data => {
        // console.log(data);
        // let formattedData = '';
        // // console.log(data)
        // Object.entries(data).forEach(([key, val]) => {
        //     formattedData += `${key}: ${val}<br>`;
        // });
        // if (data.data) {
        //     Object.entries(data.data).forEach(([key, value]) => {
        //         formattedData += ` - ${key}: ${value}<br>`;
        //     });
        // }
        // data.innerHTML = formattedData;
        // alert(data['message']);
    // })
    .catch(error => alert(error.message));
}