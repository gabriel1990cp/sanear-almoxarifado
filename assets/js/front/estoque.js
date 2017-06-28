$(document).ready(function () {
    $(".uni_hidrometro").hide();
});


$("#material").change(function () {
    var tipo = $("#material").val();

    if (tipo == 1) {
        $(".uni_hidrometro").show();
    } else {
        $(".uni_hidrometro").hide();
    }
})