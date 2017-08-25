<div class="container">
    <div class="col-md-12">
        <div class="row">
            <h1 class="page-header">
                Funcionários
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="<?= base_url('funcionarios') ?>">Funcionários</a>
                </li>
                <li class="active">
                    <i class="fa fa-table"></i>Cadastrar
                </li>
            </ol>
        </div>
    </div>
    <?php $this->load->view('include/alert.php'); ?>
    <div class="row">
        <form action="<?= base_url('funcionario/insert') ?>" method="post" enctype="multipart/form-data" id="cadastro_funcionario" class="cadastrar-funcionario">
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
                <label for="tipo">Cargo *</label>
                <select class="form-control" id="cargo" name="cargo" >
                    <option value="">Selecione ></option>
                    <?php
                    foreach ($cargos as $cargo):
                        ?>
                        <option value="<?= $cargo['id_cargo'] ?>"><?= $cargo['nome_cargo'] ?></option>
                        <?php
                    endforeach;
                    ?>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="carro">Carro</label>
                <select class="form-control" id="carro" name="carro">
                    <option value="">Selecione ></option>
                    <?php
                    foreach ($carros as $carro):
                        ?>
                        <option value="<?= $carro['id_carro'] ?>"><?= $carro['nome_carro'] ?></option>
                        <?php
                    endforeach;
                    ?>
                </select>
            </div>
            <div class="form-group col-md-6 clean">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone">
            </div>
            <div class="form-group col-md-6">
                <label for="celular">Celular</label>
                <input type="text" class="form-control" id="celular" name="celular">
            </div>
            <div class="form-group col-md-12">
                <label for="observacao">Observação</label>
                <textarea type="text" class="form-control" id="observacao" name="observacao" rows="5" style="resize: none"></textarea>
            </div>
            <div class="form-group col-md-6">
                <button type="submit" class="btn btn-primary btn-block cadastrar">Cadastrar</button>
            </div>
            <div class="form-group col-md-6">
                <a href="<?= base_url('funcionarios/') ?>" class="btn btn-danger btn-block">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<!-- SCRIPT -->
<script src="<?= base_url('assets/js/jquery.validate.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.maskedinput.js') ?>"></script>
<script src="<?= base_url('assets/js/front/funcionario.js') ?>"></script>
<!-- SCRIPT -->