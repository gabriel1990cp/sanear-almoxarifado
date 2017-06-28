<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Estoque
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="<?= base_url('funcionarios') ?>">Estoque</a>
                </li>
                <li class="active">
                    <i class="fa fa-table"></i>Entrada
                </li>
            </ol>
        </div>
    </div>
    <?php $this->load->view('include/alert.php'); ?>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="celular">Nota de remessa</label>
            <input type="text" class="form-control" id="nota_remessa" name="nota_remessa">
        </div>
        <div class="form-group col-md-6">
            <label for="celular">Atendimento de Requisição</label>
            <input type="text" class="form-control" id="nota_remessa" name="nota_remessa">
        </div>
        <div class="form-group col-md-12">
            <label for="celular">Arquivo</label>
            <input type="file" class="form-control" id="arquivo" name="arquivo">
        </div>

        <div class="form-group col-md-12">
            <label for="tipo">Material *</label>
            <select class="form-control" id="material" name="material">
                <option value="">Selecione ></option>
                <?php
                foreach ($tipos_materiais as $tipo_material):
                    ?>
                    <option value="<?= $tipo_material['id_tipo_material'] ?>"><?= $tipo_material['nome_tipo_material'] ?></option>
                    <?php
                endforeach;
                ?>
            </select>
        </div>
        <div class="form-group col-md-6 uni_hidrometro">
            <label for="rg">Número do hidrômetro</label>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Número do hidrômetro">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Adicionar</button>
                </span>
            </div>
        </div>
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