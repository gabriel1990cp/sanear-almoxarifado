<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Estoque
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
        <form action="<?= base_url('estoque/insert') ?>" method="post" enctype="multipart/form-data" id="entrada_estoque" class="entrada_estoque">
            <div class="form-group col-md-6">
                <label for="nota_remessa">Nota de remessa *</label>
                <input type="text" class="form-control" id="nota_remessa" name="nota_remessa">
                <div class="error"><?= form_error('nota_remessa'); ?></div>
            </div>
            <div class="form-group col-md-6">
                <label for="atendimento_requisicao">Atendimento de Requisição *</label>
                <input type="text" class="form-control" id="atendimento_requisicao" name="atendimento_requisicao">
                <div class="error"><?= form_error('atendimento_requisicao'); ?></div>
            </div>
            <div class="form-group col-md-12">
                <label for="arquivo">Arquivo</label>
                <input type="file" class="form-control" id="arquivo" name="arquivo">
            </div>

            <div class="form-group col-md-12">
                <label for="tipo_material">Material *</label>
                <select class="form-control" id="tipo_material" name="tipo_material">
                    <option value="">Selecione ></option>
                    <?php
                    foreach ($tipos_materiais as $tipo_material):
                        ?>
                        <option value="<?= $tipo_material['id_tipo_material'] ?>"><?= $tipo_material['nome_tipo_material'] ?></option>
                        <?php
                    endforeach;
                    ?>
                </select>
                <div class="error"><?= form_error('tipo_material'); ?></div>
            </div>
            <div class="form-group col-md-6 uni_hidrometro">
                <label for="numero_hidrometro">Número do hidrômetro</label>
                <div class="input-group">
                    <input id="numero_hidrometro" name="numero_hidrometro" type="text" class="form-control" placeholder="Número do hidrômetro">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Adicionar</button>
                    </span>
                </div>
                <div class="error"><?= form_error('numero_hidrometro'); ?></div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered responsive">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>RG</th>
                        <th>CPF</th>
                        <th>Cargo</th>
                        <th>Telefone</th>
                        <th>Celular</th>
                        <th>Carro</th>
                        <th>Status</th>
                        <th>Opção</th>
                    </tr>
                    </thead>
                    <tr>
                        <td scope="row"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script src="<?= base_url('assets/js/jquery.validate.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.maskedinput.js') ?>"></script>
<script src="<?= base_url('assets/js/front/estoque.js') ?>"></script>
<!-- SCRIPT -->