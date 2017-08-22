//VALIDAÇÕES
$("#entrada_estoque").validate({
    rules: {
        responsavel: {
            required: true
        },
        data_cadastro: {
            required: true
        },
        atendimento_requisicao: {
            required: true
        },
        nota_remessa: {
            required: true
        }
    },
    messages: {
        responsavel: {
            required: "O campo responsável é obrigatório"
        },
        data_cadastro: {
            required: "O campo data de cadastro é obrigatório"
        },
        atendimento_requisicao: {
            required: "O campo atendimento de requisição é obrigatório"
        },
        nota_remessa: {
            required: "O campo nota de remessa é obrigatório"
        }
    }
});

//VALIDAÇÕES
$("#seleciona_material_hmy").validate({
    rules: {
        inicio_caixa_hm: {
            required: true,
            minlength: 10
        },
        fim_caixa_hm: {
            required: true,
            minlength: 10
        }
    },
    messages: {
        inicio_caixa_hm: {
            required: "O campo início caixa  é obrigatório"
        },
        fim_caixa_hm: {
            required: "O campo fim caixa é obrigatório"
        }
    }
});


$(document).ready(function () {
    //VERIFICA SE O ARQUIVO FOI SELECIONADO PARA UPLOAD
    $(".cadastrar").click(function () {

        var file = $("#arquivo").val();

        if (file == '') {
            $("#erro-file").show();
            return false;
        }
    });

    //VISUALIZAR CAIXA DE HM Y
    $('.visualizar-hmy').on('click', function (e) {
        e.preventDefault();

        var caixa_hm = $(this).data('caixa_hm');

        $('#visualizar-hmy').data('caixa_hm', caixa_hm);
        $('#visualizar-hmy').modal('show');
    });

    $('#visualizar-hmy').on('show.bs.modal', function () {

        caixa_hm = $('#visualizar-hmy').data('caixa_hm');


        url = base_url + "caixa_hmy";

        $.ajax({
            type: "POST",
            url: url,
            data: {caixa_hm: caixa_hm},
            success: function (retorno) {
                $(".resultado").html(retorno);
            }
        });
    });
});


//EXCUIR USUARIO
$(function () {
    $('.confirma_exclusao').on('click', function (e) {
        e.preventDefault();

        var nome = $(this).data('nome');
        var id = $(this).data('id');
        var entrada = $(this).data('entrada');
        var material = $(this).data('material');

        $('#modal_confirmation').data('nome', nome);
        $('#modal_confirmation').data('id', id);
        $('#modal_confirmation').data('entrada', entrada);
        $('#modal_confirmation').data('material', material);
        $('#modal_confirmation').modal('show');
    });

    $('#modal_confirmation').on('show.bs.modal', function () {
        var nome = $(this).data('nome');
        $('#nome_exclusao').text(nome);
    });

    $('#btn_excluir').click(function () {
        var id = $('#modal_confirmation').data('id');
        var entrada = $('#modal_confirmation').data('entrada');
        var material = $('#modal_confirmation').data('material');
        document.location.href = base_url + "estoque/delete_caixa_hmy/" + id + "/" + entrada + "/" + material;
    });
});

//BUSCA
$("#btn_search").click(function () {

    var atendimento_requisicao = $("#atendimento_requisicao").val();
    var nota_remessa = $("#nota_remessa").val();

    //VERIFICA SE OS EMAIL'S ESTÃO IGUAIS.
    if (atendimento_requisicao == '' && nota_remessa == '') {
        $("#atendimento_requisicao-error").show();
        return false;
    }
});