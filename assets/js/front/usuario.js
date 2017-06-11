$(document).ready(function () {
    //VALIDAÇÕES
    $("#cadastro_usuario").validate({
        rules: {
            nome: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            conf_email: {
                required: true,
                email: true
            },
            perfil: {
                required: true
            },
            senha: {
                required: true,
                minlength: 8
            },
            conf_senha: {
                required: true,
                minlength: 8
            }
        },
        messages: {
            nome: {
                required: "O campo nome é obrigatório"
            },
            email: {
                required: "Digite o e-mail"
            },
            conf_email: {
                required: "Digite o confirmar e-mail"
            },
            perfil: {
                required: "Selecioneo perfil"
            },
            senha: {
                required: "Digite a senha"
            },
            conf_senha: {
                required: "Digite o confirmar Senha"
            }
        }
    });

    //VALIDAÇÕES
    $("#editar_usuario").validate({
        rules: {
            nome: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            conf_email: {
                required: true,
                email: true
            },
            perfil: {
                required: true
            }
        },
        messages: {
            nome: {
                required: "O campo nome é obrigatório"
            },
            email: {
                required: "Digite o e-mail"
            },
            conf_email: {
                required: "Digite o confirmar e-mail"
            },
            perfil: {
                required: "Selecioneo perfil"
            }
        }
    });

    //CADASTRAR USUARIO
    $(".cadastrar").click(function () {

        var email = $("#email").val();
        var conf_email = $("#conf_email").val();
        var senha = $("#senha").val();
        var conf_senha = $("#conf_senha").val();

        //VERIFICAR SE O EMAIL E O CONF EMAIL SÃO IGUAIS
        if (email !== conf_email && email != '' && conf_email != '') {

            $(".error-email").text("Ops, o campo e-mail e confirmar e-mail devem ser iguais.");
            $(".error-conf-email").text("Ops, o campo e-mail e confirmar e-mail devem ser iguais.");
            return false;
        }

        //VERIFICAR SE O SENHA E O CONF SÃO IGUAIS
        if (senha !== conf_senha && senha != '' && conf_senha != '') {

            $(".error-senha").text("Ops, o campo senha e confirmar senha devem ser iguais.");
            $(".error-conf-senha").text("Ops, o campo senha e confirmar senha devem ser iguais.");
            return false;
        }
    });

    //ATUALIZAR USUARIO
    $(".atualizar").click(function () {



        var email = $("#email").val();
        var conf_email = $("#conf_email").val();
        var senha_atual = $("#senha_atual").val();
        var senha = $("#senha").val();
        var conf_senha = $("#conf_senha").val();

        //VERIFICAR SE O EMAIL E O CONF EMAIL SÃO IGUAIS
        if (email !== conf_email && email != '' && conf_email != '') {

            $(".error-email").text("Ops, o campo e-mail e confirmar e-mail devem ser iguais.");
            $(".error-conf-email").text("Ops, o campo e-mail e confirmar e-mail devem ser iguais.");
            return false;
        }

        //VERIFICAR SE O SENHA E O CONF SÃO IGUAIS
        if (senha_atual.length > 0) {
            if (senha !== conf_senha) {
                $(".error-senha").text("Ops, o campo senha e confirmar senha devem ser iguais.");
                $(".error-conf-senha").text("Ops, o campo senha e confirmar senha devem ser iguais.");
                return false;
            }

            //VERIFICA SE TEM NO MINIMO 8 CARACTERES
            if (senha.length < 8 || conf_senha.length < 8){
                $(".error-senha").text("Insira pelo menos 8 caracteres.");
                $(".error-conf-senha").text("Insira pelo menos 8 caracteres.");
                return false;
            }
        }

        if (senha_atual.length == 0 && (senha.length > 0 || conf_senha.length > 0 )) {
            $(".error-senha-atual").text("Ops, o campo senha atual é obrigatório.");
            return false;
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
            document.location.href = base_url + "usuario/delete/" + id;
        });
    });

    $("#rg").mask("99.999.999-?*");
    $("#cpf").mask("999.999.999-*?*");
});

