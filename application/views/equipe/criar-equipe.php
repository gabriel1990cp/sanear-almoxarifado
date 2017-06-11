<div class="container">
    <div class="col-md-12">
        <div class="row">
            <h1 class="page-header">
                Equipes
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="<?= base_url('equipes') ?>">Equipes</a>
                </li>
                <li class="active">
                    <i class="fa fa-table"></i>Cadastrar
                </li>
            </ol>
        </div>
    </div>
    <?php $this->load->view('include/alert.php'); ?>
    <div class="row">
        <form action="<?= base_url('equipe/insert') ?>" method="post" enctype="multipart/form-data" id="cadastro_equipe" class="cadastrar-equipe">
            <div class="form-group col-md-12">
                <label for="nome_equipe">Nome da equipe *</label>
                <input class="form-control" type="text" id="nome_equipe" name="nome_equipe">
                <div class="error"><?= form_error('nome_equipe'); ?></div>
            </div>
            <div class="form-group col-md-6">
                <label for="nome">Inspetor *</label>
                <select class="form-control" id="inspetor" name="inspetor">
                    <option value="">Selecione ></option>
                    <?php
                    foreach ($funcPermitidos as $funcionario):
                        ?>
                        <option value="<?= $funcionario['id_funcionario'] ?>"><?= $funcionario['nome_funcionario'] ?> - <?= $funcionario['nome_cargo'] ?></option>
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
                        <option value="<?= $tipoEquipe['id_tipo_equipe'] ?>"><?= $tipoEquipe['nome_tipo_equipe'] ?></option>
                        <?php
                    endforeach;
                    ?>
                </select>
                <div class="error"><?= form_error('tipo_equipe'); ?></div>
            </div>
            <div class="form-group col-md-12">
                <label for="observacao">Observação</label>
                <textarea type="text" class="form-control" id="observacao" name="observacao" rows="5" style="resize: none"></textarea>
            </div>
            <div class="form-group col-md-6">
                <button type="submit" class="btn btn-primary btn-block cadastrar">Cadastrar</button>
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