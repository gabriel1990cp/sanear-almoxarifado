<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Estoque - <small>Cadastrar saída</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="<?= base_url('#') ?>">Estoque</a>
                </li>
                <li class="active">
                    <i class="fa fa-table"></i>Entrada
                </li>
            </ol>
        </div>
    </div>
    <?php $this->load->view('include/alert.php'); ?>
    <div class="row">
        <form action="<?= base_url('cadastrar-saida') ?>" method="post" enctype="multipart/form-data" id="saida_estoque" class="saida_estoque">
            <div class="form-group col-md-6">
                <label for="responsavel">Responsável *</label>
                <input type="text" class="form-control" id="responsavel" name="responsavel" disabled value="Gabriel Costa">
            </div>
            <div class="form-group col-md-6">
                <label for="data_cadastro">Data de cadastro *</label>
                <input type="text" class="form-control" id="data_cadastro" name="data_cadastro" disabled value="<?=date('d/m/Y H:i:s')?>">
            </div>
            <div class="form-group col-md-12">
                <label for="equipe">Equipe *</label>
                <div class="error"><?= form_error('equipe'); ?></div>
                <select class="form-control" id="equipe" name="equipe">
                    <option value="">Selecione ></option>
                    <?php
                    foreach ($equipes as $equipe):
                        ?>
                        <option value="<?= $equipe['id_equipe'] ?>"><?= $equipe['nome_equipe'] ?></option>
                        <?php
                    endforeach;
                    ?>
                </select>

            </div>
            <div class="form-group col-md-6">
                <button type="submit" class="btn btn-primary btn-block cadastrar">Cadastrar</button>
            </div>
            <div class="form-group col-md-6">
                <a href="<?= base_url('estoque/') ?>" class="btn btn-danger btn-block">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<!-- SCRIPT -->
<script src="<?= base_url('assets/js/jquery.validate.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.maskedinput.js') ?>"></script>
<script src="<?= base_url('assets/js/front/estoque.js') ?>"></script>
<!-- SCRIPT -->