<div class="container">
    <div class="col-md-12">
        <div class="row">
            <h1 class="page-header">
                Usúarios
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="<?= base_url('usuario') ?>">Usúarios</a>
                </li>
                <li class="active">
                    <i class="fa fa-table"></i> Cadastrar
                </li>
            </ol>
        </div>
    </div>
    <?php $this->load->view('include/alert.php'); ?>
    <div class="row">
        <form action="<?= base_url('usuario/insert') ?>" method="post" enctype="multipart/form-data" id="cadastro_usuario" class="cadastrar-usuario">
            <div class="form-group col-md-12">
                <label for="nome">Nome *</label>
                <input type="text" class="form-control" id="nome" name="nome">
                <div class="error"><?= form_error('nome'); ?></div>
            </div>

            <div class="form-group col-md-6">
                <label for="rg">RG</label>
                <input type="text" class="form-control" id="rg" name="rg">
            </div>

            <div class="form-group col-md-6">
                <label for="cpf">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf">
            </div>

            <div class="form-group col-md-6">
                <label for="email">E-mail *</label>
                <input type="text" class="form-control" id="email" name="email">
                <div class="error error-email"><?= form_error('email'); ?></div>
            </div>

            <div class="form-group col-md-6">
                <label for="conf_email">Confirmar E-mail *</label>
                <input type="text" class="form-control" id="conf_email" name="conf_email">
                <div class="error error-conf-email"><?= form_error('conf_email'); ?></div>
            </div>

            <div class="form-group col-md-6 clean">
                <label for="mat_sabesp">Matrícula Sanear</label>
                <input type="text" class="form-control" id="mat_sanear" name="mat_sanear">
            </div>

            <div class="form-group col-md-6">
                <label for="perfil">Perfil *</label>
                <select class="form-control" id="perfil" name="perfil">
                    <option value="">Selecione ></option>
                    <option value="<?= PERFIL_ADMINISTRATIVO ?>">Administrativo</option>
                    <option value="<?= PERFIL_ALMOXARIFADO ?>">Almoxarifado</option>
                    <option value="<?= PERFIL_SUPERVISOR ?>">Supervisor</option>
                </select>
                <div class="error"><?= form_error('perfil'); ?></div>
            </div>
            <div class="form-group col-md-6">
                <label for="senha">Senha *</label>
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Sua senha deve conter no mínimo 8 dígitos">
                <div class="error error-senha"><?= form_error('senha'); ?></div>
            </div>
            <div class="form-group col-md-6">
                <label for="conf_senha">Confirmar Senha *</label>
                <input type="password" class="form-control" id="conf_senha" name="conf_senha" placeholder="Sua senha deve conter no mínimo 8 dígitos">
                <div class="error error-conf-senha"><?= form_error('conf_senha'); ?></div>
            </div>
            <div class="form-group col-md-6">
                <button type="submit" class="btn btn-primary btn-block cadastrar">Cadastrar</button>
            </div>
            <div class="form-group col-md-6">
                <a href="<?= base_url('usuarios/') ?>" class="btn btn-danger btn-block">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<!-- SCRIPT -->
<script src="<?= base_url('assets/js/jquery.validate.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.maskedinput.js') ?>"></script>
<script src="<?= base_url('assets/js/front/usuario.js') ?>"></script>
<!-- SCRIPT -->