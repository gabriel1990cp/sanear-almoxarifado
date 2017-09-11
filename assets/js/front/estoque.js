//VALIDAÇÕES ENTRADA DE ESTOQUE
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

//VALIDAÇÕES CADASTRAR CAIXA DE HM
$("#cadastrar_hmy").validate({
    rules: {
        inicio_caixa_hm: {
            required: true,
            minlength: 10,
            maxlength: 10
        },
        fim_caixa_hm: {
            required: true,
            minlength: 10,
            maxlength: 10
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

//VALIDAÇÕES PARA CADASTRAR HM AVULSO
$("#seleciona_material_hm").validate({
    rules: {
        hm_avulso: {
            required: true,
            minlength: 6,
            maxlength: 10,
        }
    },
    messages: {
        hm_avulso: {
            required: "O campo hidrômetro é obrigatório"
        }
    }
});

//VALIDAÇÕES PARA CADASTRAR PACOTE DE LACRE
$("#cadastrar_pacote_lacre").validate({
    rules: {
        inicio_pacote_lacre: {
            required: true,
            minlength: 6,
            maxlength: 6
        },
        fim_pacote_lacre: {
            required: true,
            minlength: 6,
            maxlength: 6
        }
    },
    messages: {
        inicio_pacote_lacre: {
            required: "O campo início pacote é obrigatório"
        },
        fim_pacote_lacre: {
            required: "O campo fim pacote é obrigatório"
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

    //VISUALIZAR CAIXA DE HIDROMETRO Y
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

    //VISUALIZAR PACOTE DE LACRE
    $('.visualizar-lacre').on('click', function (e) {
        e.preventDefault();

        var pacote_lacre = $(this).data('pacote_lacre');

        $('#visualizar-lacre').data('pacote_lacre', pacote_lacre);
        $('#visualizar-lacre').modal('show');

    });

    $('#visualizar-lacre').on('show.bs.modal', function () {

        pacote_lacre = $('#visualizar-lacre').data('pacote_lacre');


        url = base_url + "pacote_lacre";

        $.ajax({
            type: "POST",
            url: url,
            data: {pacote_lacre: pacote_lacre},
            success: function (retorno) {
                $(".resultado_lacre").html(retorno);
            }
        });
    });

});


//EXCLUIR PACOTE DE LACRE
$(function () {
    $('.confirma_exclusao_pacote_lacre').on('click', function (e) {
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

    $('#btn_excluir_lacre').click(function () {
        var id = $('#modal_confirmation').data('id');
        var entrada = $('#modal_confirmation').data('entrada');
        var material = $('#modal_confirmation').data('material');
        document.location.href = base_url + "estoque/deletar_pacote_lacre/" + id + "/" + entrada + "/" + material;
    });
});

//EXCUIR CAIXA DE HIDROMETRO Y
$(function () {
    $('.confirma_exclusao_caixa_hmy').on('click', function (e) {
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


    $('#btn_excluir_caixa_hmy').click(function () {
        var id = $('#modal_confirmation').data('id');
        var entrada = $('#modal_confirmation').data('entrada');
        var material = $('#modal_confirmation').data('material');
        document.location.href = base_url + "estoque/delete_caixa_hmy/" + id + "/" + entrada + "/" + material;
    });
});

//EXCLUIR HIDROMETRO AVULSO
$(function () {
    $('.confirma_exclusao_hm_avulso').on('click', function (e) {
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
        document.location.href = base_url + "estoque/delete_caixa_hm_avulso/" + id + "/" + entrada + "/" + material;
    });
});

//EXCLUIR MOLA
$(function () {
    $('.confirma_exclusao_mola').on('click', function (e) {
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

    $('#btn_excluir_mola').click(function () {
        var id = $('#modal_confirmation').data('id');
        var entrada = $('#modal_confirmation').data('entrada');
        var material = $('#modal_confirmation').data('material');
        document.location.href = base_url + "estoque/delete_mola/" + id + "/" + entrada + "/" + material;
    });
});

//EXCLUIR ENTRADA DO ESTOQUE
$(function () {
    $('.confirma_exclusao_entrada_estoque').on('click', function (e) {
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

    $('#btn_excluir_entrada').click(function () {
        var id = $('#modal_confirmation').data('id');
        var entrada = $('#modal_confirmation').data('entrada');
        var material = $('#modal_confirmation').data('material');
        document.location.href = base_url + "estoque/deletar_entrada/" + id;
    });
});

//FINALIZAR ENTRADA DO ESTOQUE
$(function () {
    $('.finalizar_entrada_estoque').on('click', function (e) {

        alert('teste');

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

    $('#btn_excluir_entrada').click(function () {
        var id = $('#modal_confirmation').data('id');
        var entrada = $('#modal_confirmation').data('entrada');
        var material = $('#modal_confirmation').data('material');
        document.location.href = base_url + "estoque/deletar_entrada/" + id;
    });
});

//BUSCA DE ENTRADAS CADASTRADAS
$("#btn_search").click(function () {

    var atendimento_requisicao = $("#atendimento_requisicao").val();
    var nota_remessa = $("#nota_remessa").val();

    //VERIFICA SE OS EMAIL'S ESTÃO IGUAIS.
    if (atendimento_requisicao == '' && nota_remessa == '') {
        $("#atendimento_requisicao-error").show();
        return false;
    }
});

