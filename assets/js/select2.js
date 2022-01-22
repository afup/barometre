$(document).ready(function () {
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        return;
    }
    $(".select2").select2({
        closeOnSelect: false,
        placeholder: "Choisir une valeur",
        theme: "bootstrap",
        width: '100%'
    });
});

