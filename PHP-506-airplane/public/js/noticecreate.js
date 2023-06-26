function displaySelectedImage(event) {
    const image = event.target.files[0];
    const imageURL = URL.createObjectURL(image);
    const selectedImage = document.getElementById('selectedImage');
    selectedImage.src = imageURL;
    selectedImage.style = 'display: block';
}

function updateTextarea() {
    let divContent = document.getElementById('divContent');
    let contentTextarea = document.getElementById('content');
    contentTextarea.value = divContent.innerText;
}