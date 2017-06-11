$(document).ready(function () {

    $(".validacao-encanador").hide();

    //VALIDAÇÕES
    $(".inserir").on('click', function (e) {
        e.preventDefault()

        var encanador = $("#resultado-encanador").val();

        if (encanador !== '' && encanador > 0 ) {
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
            var equipe = $(this).data('equipe');

            $('#modal_confirmation').data('nome', nome);
            $('#modal_confirmation').data('id', id);
            $('#modal_confirmation').data('equipe', equipe);
            $('#modal_confirmation').modal('show');
        });

        $('#modal_confirmation').on('show.bs.modal', function () {
            var nome = $(this).data('nome');
            $('#nome_exclusao').text(nome);
        });

        $('#btn_excluir').click(function () {
            var id = $('#modal_confirmation').data('id');
            var equipe = $('#modal_confirmation').data('equipe');

            document.location.href = base_url + "equipe/delete_employee/" + id + "/" + equipe;
        });
    });
})
;


