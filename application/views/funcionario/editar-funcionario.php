<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Funcionários
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="<?= base_url('usuario') ?>">Funcionários</a>
                </li>
                <li class="active">
                    <i class="fa fa-table"></i> Editar
                </li>
            </ol>
        </div>
    </div>
    <?php $this->load->view('include/alert.php'); ?>
    <div class="row">
        <form action="<?= base_url('funcionario/insert_edit') ?>" method="post" enctype="multipart/form-data" id="editar_funcionario" class="cadastrar-funcionario">
            <input type="hidden" value="<?= $funcionario[0]['id_funcionario'] ?>" name="id_funcionario">
            <div class="form-group col-md-12">
                <label for="nome">Nome *</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?= $funcionario[0]['nome_funcionario'] ?>">
                <div class="error"><?= form_error('nome'); ?></div>
            </div>
            <div class="form-group col-md-6">
                <label for="rg">RG</label>
                <input type="text" class="form-control" id="rg" name="rg" value="<?= $funcionario[0]['rg_funcionario'] ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="cpf">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf" value="<?= $funcionario[0]['cpf_funcionario'] ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="tipo">Cargo *</label>
                <select class="form-control" id="cargo" name="cargo">
                    <option value="">Selecione ></option>
                    <?php
                    foreach ($cargos as $cargo):
                        ?>
                        <option <?php if ($cargo['id_cargo'] == $funcionario[0]['cargo_funcionario']) { echo "selected"; }?> value="<?= $cargo['id_cargo'] ?>"><?= $cargo['nome_cargo'] ?></option>
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
                        <option  <?php if ($carro['id_carro'] == $funcionario[0]['carro_funcionario']) { echo "selected"; }?>  value="<?= $carro['id_carro'] ?>"><?= $carro['nome_carro'] ?></option>
                        <?php
                    endforeach;
                    ?>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" value="<?= $funcionario[0]['telefone_funcionario'] ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="celular">Celular</label>
                <input type="text" class="form-control" id="celular" name="celular" value="<?= $funcionario[0]['celular_funcionario'] ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="celular">Status</label>
                <select class="form-control" id="status" name="status">
                    <option <?php if ($funcionario[0]['status_funcionario'] == "ativo") { echo "selected"; } ?> value="ativo">Ativo </option>
                    <option <?php if ($funcionario[0]['status_funcionario'] == "inativo") { echo "selected"; } ?> value="inativo">Inativo  </option>
                </select>
                <div class="error"><?= form_error('status'); ?></div>
            </div>
            <div class="form-group col-md-12">
                <label for="observacao">Observação</label>
                <textarea type="text" class="form-control" id="observacao" name="observacao" rows="5" style="resize: none"><?= $funcionario[0]['observacao_funcionario'] ?></textarea>
            </div>
            <div class="form-group col-md-6 clean">
                <button type="submit" class="btn btn-primary btn-block atualizar">Atualizar</button>
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