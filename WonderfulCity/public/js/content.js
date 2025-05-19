function displayPopup(src) {
    var popup = document.getElementById("image-popup");
    var popupImage = document.getElementById("popup-image");
    popupImage.src = src;
    popup.style.display = "flex";
}

function closePopup() {
    var popup = document.getElementById("image-popup");
    popup.style.display = "none";
}

