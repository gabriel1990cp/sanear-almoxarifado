<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Usúarios
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="<?= base_url('usuario') ?>">Usúarios</a>
                </li>
                <li class="active">
                    <i class="fa fa-table"></i> Editar
                </li>
            </ol>
        </div>
    </div>
    <?php $this->load->view('include/alert.php'); ?>
    <div class="row">
        <form action="<?= base_url('usuario/insert_edit') ?>" method="post" enctype="multipart/form-data" id="editar_usuario" class="cadastrar-usuario">
            <input type="hidden" value="<?= $usuarios[0]['id_usuario'] ?>" name="id_usuario">
            <div class="form-group col-md-12">
                <label for="nome">Nome *</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?= $usuarios[0]['nome_usuario'] ?>">
                <div class="error"><?= form_error('nome'); ?></div>
            </div>

            <div class="form-group col-md-6">
                <label for="rg">RG</label>
                <input type="text" class="form-control" id="rg" name="rg" value="<?= $usuarios[0]['rg_usuario'] ?>">
            </div>

            <div class="form-group col-md-6">
                <label for="cpf">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf" value="<?= $usuarios[0]['cpf_usuario'] ?>">
            </div>

            <div class="form-group col-md-6">
                <label for="email">E-mail *</label>
                <input type="text" class="form-control" id="email" name="email" value="<?= $usuarios[0]['email_usuario'] ?>">
                <div class="error error-email"><?= form_error('email'); ?></div>
            </div>

            <div class="form-group col-md-6">
                <label for="conf_email">Confirmar E-mail *</label>
                <input type="text" class="form-control" id="conf_email" name="conf_email" value="<?= $usuarios[0]['email_usuario'] ?>">
                <div class="error error-conf-email"><?= form_error('conf_email'); ?></div>
            </div>

            <div class="form-group col-md-6 clean">
                <label for="mat_sabesp">Matrícula Sanear</label>
                <input type="text" class="form-control" id="mat_sabesp" name="mat_sabesp" value="<?= $usuarios[0]['matricula_usuario'] ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="perfil">Perfil *</label>
                <select class="form-control" id="perfil" name="perfil">
                    <option value="">Selecione ></option>
                    <option <?php if ($usuarios[0]['perfil_usuario'] == PERFIL_ADMINISTRATIVO) { echo "selected"; } ?> value="<?= PERFIL_ADMINISTRATIVO ?>">Administrativo </option>
                    <option <?php if ($usuarios[0]['perfil_usuario'] == PERFIL_ALMOXARIFADO) {
                        echo "selected";
                    } ?> value="<?= PERFIL_ALMOXARIFADO ?>">Almoxarifado
                    </option>
                    <option <?php if ($usuarios[0]['perfil_usuario'] == PERFIL_SUPERVISOR) {
                        echo "selected";
                    } ?> value="<?= PERFIL_SUPERVISOR ?>">Supervisor
                    </option>
                </select>
                <div class="error"><?= form_error('perfil'); ?></div>
            </div>
            <div class="form-group col-md-6">
                <label for="perfil">Status *</label>
                <select class="form-control" id="status" name="status">
                    <option <?php if ($usuarios[0]['status_usuario'] == "ativo") { echo "selected"; } ?> value="ativo">Ativo </option>
                    <option <?php if ($usuarios[0]['status_usuario'] == "inativo") { echo "selected"; } ?> value="inativo">Inativo  </option>
                </select>
                <div class="error"><?= form_error('status'); ?></div>
            </div>
            <div class="form-group col-md-6">
                <label for="senha">Senha atual</label>
                <input type="password" class="form-control" id="senha_atual" name="senha_atual" placeholder="Sua senha atual">
                <div class="error error-senha-atual"><?= form_error('senha'); ?></div>
            </div>
            <div class="form-group col-md-6">
                <label for="senha">Nova senha</label>
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Sua senha deve conter no mínimo 8 dígitos">
                <div class="error error-senha"><?= form_error('senha'); ?></div>
            </div>
            <div class="form-group col-md-6">
                <label for="conf_senha">Confirmar Senha</label>
                <input type="password" class="form-control" id="conf_senha" name="conf_senha" placeholder="Sua senha deve conter no mínimo 8 dígitos">
                <div class="error error-conf-senha"><?= form_error('conf_senha'); ?></div>
            </div>
            <div class="form-group col-md-6 clean">
                <button type="submit" class="btn btn-primary btn-block atualizar">Atualizar</button>
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