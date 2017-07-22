<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Material
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="<?= base_url('#') ?>">Estoque</a>
                </li>
                <li class="active">
                    <i class="fa fa-table"></i>Material
                </li>
            </ol>
        </div>
    </div>
    <?php $this->load->view('include/alert.php'); ?>
    <div class="row">
        <div class="form-group col-md-12">
            <label for="nota_remessa">Tipo material *</label>
            <select class="form-control" id="cargo" name="cargo">
                <option value="">Selecione ></option>
                <?php
                foreach ($tipo_material as $material):
                    ?>
                    <option value="<?= $material['id_tipo_material'] ?>"><?= $material['nome_tipo_material'] ?></option>
                    <?php
                endforeach;
                ?>
            </select>
            <div class="error"><?= form_error('nota_remessa'); ?></div>
        </div>
        <form action="<?= base_url('estoque/entrada_estoque_cxhm') ?>" method="post" enctype="multipart/form-data" id="entrada_estoque_cxhm" class="entrada_estoque_cxhm">
            <input type="hidden" id="id_entrada_material" name="id_entrada_material" value="<?=$id_entrada_material?>">
            <div class="form-group col-md-4">
                <label for="inicio_caixa_hm">Início caixa *</label>
                <input type="text" class="form-control" id="inicio_caixa_hm" name="inicio_caixa_hm">
            </div>
            <div class="form-group col-md-4">
                <label for="fim_caixa_hm">Fim caixa*</label>
                <input type="text" class="form-control" id="fim_caixa_hm" name="fim_caixa_hm">
            </div>
            <div class="form-group col-md-4">
                <button type="submit" class="btn btn-primary btn-block cadastrar-hm">Adicionar</button>
            </div>
        </form>
        <div class="form-group col-md-6">
            <button type="submit" class="btn btn-primary btn-block cadastrar">Cadastrar</button>
        </div>
        <div class="form-group col-md-6">
            <a href="<?= base_url('equipes/') ?>" class="btn btn-danger btn-block">Cancelar</a>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script src="<?= base_url('assets/js/jquery.validate.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.maskedinput.js') ?>"></script>
<script src="<?= base_url('assets/js/front/entrada_material.js') ?>"></script>
<!-- SCRIPT -->