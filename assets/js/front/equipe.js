$(document).ready(function () {

    //VALIDAÇÕES
    $("#cadastro_equipe").validate({
        rules: {
            nome_equipe: {
                required: true
            },
            inspetor: {
                required: true
            },
            tipo_equipe: {
                required:true
            }
        },
        messages: {
            nome_equipe: {
                required: "O campo nome é obrigatório"
            },
            inspetor: {
                required: "O campo inspetor é obrigatório"
            },
            tipo_equipe: {
                required: "O campo tipo de quipe é obrigatório"
            }
        }
    });

    //BUSCA
    $("#btn_search").click(function () {

        var nome = $("#nome").val();
        var tipo_equipe = $("#tipo_equipe").val();

        if (nome == '' && tipo_equipe == '') {
            $("#erro-busca-error").show();
            return false;
        }
    });

    //EXCLUIR EQUIPE
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
});


