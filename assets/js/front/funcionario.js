$(document).ready(function () {

    $("#cargo").change(function () {

        var tipo = $("#cargo").val();

        if (tipo == '3' || tipo == '1') {
            $("#carro").prop("disabled", true);
        } else {
            $("#carro").prop("disabled", false);
        }
    });

    //VALIDAÇÕES
    $("#cadastro_funcionario").validate({
        rules: {
            nome: {
                required: true
            },
            cargo: {
                required: true
            }
        },
        messages: {
            nome: {
                required: "O campo nome é obrigatório"
            },
            cargo: {
                required: "O campo cargo é obrigatório"
            }
        }
    });

    //VALIDAÇÕES
    $("#editar_funcionario").validate({
        rules: {
            nome: {
                required: true
            }
        },
        messages: {
            nome: {
                required: "O campo nome é obrigatório"
            }
        }
    });

    //BUSCA
    $("#btn_search").click(function () {

        var nome = $("#nome").val();
        var cpf = $("#cpf").val();

        //VERIFICA SE OS EMAIL'S ESTÃO IGUAIS.
        if (nome == '' && cpf == '') {
            $("#nome-error").show();
            return false;
        }
    });

    //EXCUIR USUARIO
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
            document.location.href = base_url + "funcionario/delete/" + id;
        });
    });

    $("#rg").mask("99.999.999-?*");
    $("#cpf").mask("999.999.999-*?*");
    $("#telefone").mask("999-9999-9999");
    $("#celular").mask("999-99999-9999");
});


