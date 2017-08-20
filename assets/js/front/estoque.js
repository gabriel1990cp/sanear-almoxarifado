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

$(document).ready(function () {
    $(".cadastrar").click(function () {

        var file = $("#arquivo").val();

        if (file == '')
        {
            $("#erro-file").show();
            return false;
        }
    });
});
