$(document).ready(function () {

    $(".validacao-encanador").hide();

    //VALIDAÇÕES
    $(".inserir").on('click', function (e) {
        e.preventDefault()

        var encanador = $("#encanador").val();
        if (encanador !== '') {
            $("#cadastro_encanador").submit();
        } else {
            $(".validacao-encanador").show();

        }
    });

//EXCLUIR ENCANADOR
    $(function () {
        $('.confirma_exclusao').on('click', function (e) {
            e.preventDefault();

            var nome = $(this).data('nome');
            var id = $(this).data('id');

            $('#modal_confirmation').data('nome', nome);
            $('#modal_confirmation').data('id', id);
            $('#modal_confirmation').modal('show');
        });

        $('#modal_confirmation').on('show.bs.modal', function () {
            var nome = $(this).data('nome');
            $('#nome_exclusao').text(nome);
        });

        $('#btn_excluir').click(function () {
            var id = $('#modal_confirmation').data('id');
            document.location.href = base_url + "equipe/delete/" + id;
        });
    });
})
;


