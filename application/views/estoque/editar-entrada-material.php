<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Estoque
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="<?= base_url('Entradaestoque') ?>">Estoque</a>
                </li>
                <li class="active">
                    <i class="fa fa-table"></i>Entrada
                </li>
            </ol>
        </div>
    </div>
    <?php $this->load->view('include/alert.php'); ?>
    <div class="row">
        <form action="<?= base_url('salvar-editar-entrada') ?>" method="post" enctype="multipart/form-data" id="entrada_estoque" class="entrada_estoque">
            <input type="hidden" name="id_entrada" value="<?= $dadosEntrada['0']['id_est_entrada']?>">
            <div class="form-group col-md-6">
                <label for="responsavel">Responsável *</label>
                <input type="text" class="form-control" id="responsavel" name="responsavel" disabled value="Gabriel Costa">
            </div>
            <div class="form-group col-md-6">
                <label for="data_cadastro">Data de cadastro *</label>
                <input type="text" class="form-control" id="data_cadastro" name="data_cadastro" disabled value="<?=date('d/m/Y H:i:s')?>">
            </div>
            <div class="form-group col-md-6">
                <label for="atendimento_requisicao">Atendimento de Requisição *</label>
                <input type="text" class="form-control" id="atendimento_requisicao" name="atendimento_requisicao" value="<?= $dadosEntrada['0']['atend_requisicao_est_entrada']?>">
                <div class="error"><?= form_error('atendimento_requisicao'); ?></div>
            </div>

            <div class="form-group col-md-6">
                <label for="nota_remessa">Nota de remessa *</label>
                <input type="text" class="form-control" id="nota_remessa" name="nota_remessa" value="<?= $dadosEntrada['0']['nota_remessa_est_entrada']?>">
                <div class="error"><?= form_error('nota_remessa'); ?></div>
            </div>
            <div class="form-group col-md-12">
                <p>Arquivo: <a href="<?= base_url('uploads/'). $dadosEntrada['0']['arquivo_est_entrada'] ?>" download=""><?= $dadosEntrada[0]['arquivo_est_entrada'];?></a></p>
                <label for="arquivo">Arquivo</label>
                <input type="file" class="form-control" id="arquivo" name="arquivo">
                <label id="erro-file" class="error display-none" for="nome">Ops, selecione o arquivo para upload.</label>
            </div>
            <div class="form-group col-md-6">
                <button type="submit" class="btn btn-primary btn-block editar-entrada">Cadastrar</button>
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