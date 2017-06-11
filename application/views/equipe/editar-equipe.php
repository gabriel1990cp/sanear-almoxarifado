<div class="container">
    <div class="col-md-12">
        <div class="row">
            <h1 class="page-header">
                Equipe
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="<?= base_url('equipes') ?>">Equipes</a>
                </li>
                <li class="active">
                    <i class="fa fa-table"></i>Editar
                </li>
            </ol>
        </div>
    </div>
    <?php $this->load->view('include/alert.php'); ?>
    <div class="row">
        <form action="<?= base_url('equipe/insert_edit') ?>" method="post" enctype="multipart/form-data" id="cadastro_equipe" class="cadastro_equipe">
            <input type="hidden" value="<?= $equipes[0]['id_equipe'] ?>" name="id_equipe">
            <div class="form-group col-md-12">
                <label for="nome_equipe">Nome da equipe *</label>
                <input class="form-control" type="text" id="nome_equipe" name="nome_equipe" value="<?= $equipes[0]['nome_equipe'] ?>">
                <div class="error"><?= form_error('nome_equipe'); ?></div>
            </div>
            <div class="form-group col-md-6">
                <label for="nome">Inspetor *</label>
                <select class="form-control" id="inspetor" name="inspetor">
                    <option value="">Selecione ></option>
                    <?php
                    foreach ($funcPermitidos as $funcionario):
                        ?>
                        <option <?php if ($funcionario['id_funcionario'] == $equipes[0]['inspetor_equipe']) { echo "selected"; }?> value="<?= $funcionario['id_funcionario'] ?>"><?= $funcionario['nome_funcionario'] ?> - <?= $funcionario['nome_cargo'] ?></option>
                        <?php
                    endforeach;
                    ?>
                </select>
                <div class="error"><?= form_error('inspetor'); ?></div>
            </div>
            <div class="form-group col-md-6">
                <label for="nome">Tipo Equipe *</label>
                <select class="form-control" id="tipo_equipe" name="tipo_equipe">
                    <option value="">Selecione ></option>
                    <?php
                    foreach ($tipoEquipes as $tipoEquipe):
                        ?>
                        <option <?php if ($tipoEquipe['id_tipo_equipe'] == $equipes[0]['tipo_equipe']) { echo "selected"; }?> value="<?= $tipoEquipe['id_tipo_equipe'] ?>"><?= $tipoEquipe['nome_tipo_equipe'] ?></option>
                        <?php
                    endforeach;
                    ?>
                </select>
                <div class="error"><?= form_error('tipo_equipe'); ?></div>
            </div>
            <div class="form-group col-md-6">
                <label for="celular">Status</label>
                <select class="form-control" id="status" name="status">
                    <option <?php if ($equipes[0]['status_equipe'] == "ativo") { echo "selected"; } ?> value="ativo">Ativo </option>
                    <option <?php if ($equipes[0]['status_equipe'] == "inativo") { echo "selected"; } ?> value="inativo">Inativo  </option>
                </select>
                <div class="error"><?= form_error('status'); ?></div>
            </div>
            <div class="form-group col-md-12">
                <label for="observacao">Observação</label>
                <textarea type="text" class="form-control" id="observacao" name="observacao" rows="5" style="resize: none"><?= $equipes[0]['observacao_equipe'] ?></textarea>
            </div>
            <div class="form-group col-md-6">
                <button type="submit" class="btn btn-primary btn-block cadastrar">Atualizar</button>
            </div>
            <div class="form-group col-md-6">
                <a href="<?= base_url('equipes/') ?>" class="btn btn-danger btn-block">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<!-- SCRIPT -->
<script src="<?= base_url('assets/js/jquery.validate.js') ?>"></script>
<script src="<?= base_url('assets/js/front/equipe.js') ?>"></script>
<!-- SCRIPT -->