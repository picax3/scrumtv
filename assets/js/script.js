function volumeToggle(button) {
    var muted = $(".previewVideo").prop("muted");
    $(".previewVideo").prop("muted", !muted);

    $(button).find("i").toggleClass("fa-solid fa-volume-xmark");
    $(button).find("i").toggleClass("fa-solid fa-volume-high");
}

function previewEnded() {
    $(".previewVideo").toggle();
    $(".previewImage").toggle();
}