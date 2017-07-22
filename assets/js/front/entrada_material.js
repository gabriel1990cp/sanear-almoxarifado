$(document).ready(function () {
    $(".uni_hidrometro").hide();
});


$("#tipo_material").change(function () {
    var tipo = $("#tipo_material").val();

    if (tipo == 1) {
        $(".uni_hidrometro").show();
    } else {
        $(".uni_hidrometro").hide();
    }
})