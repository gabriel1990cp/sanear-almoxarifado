$(document).ready(function () {
    $(".hm-y").hide();
    $(".hm-abcd").hide();
});


$("#tipo_material").change(function () {

    var tipo = $("#tipo_material").val();

    if (tipo == 5 || tipo == 6) {
        $(".hm-y").show();
    } else {
        $(".hm-y").hide();
    }

    if (tipo == 1 || tipo == 2 || tipo == 3 || tipo == 4) {
        $(".hm-abcd").show();
    } else {
        $(".hm-abcd").hide();
    }
})