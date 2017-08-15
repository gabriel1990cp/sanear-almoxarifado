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
        <form action="<?= base_url('estoque/entrada_tipo_material') ?>" method="post" enctype="multipart/form-data" id="seleciona_material" class="seleciona_material">
            <input type="hidden" value="<?= $id_entrada_material ?>" name="id_entrada_material" id="id_entrada_material">
            <div class="form-group col-md-12">
                <label for="tipo_material">Tipo de material *</label>
                <select class="form-control" id="tipo_material" name="tipo_material">
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
        </form>

        <?php
        if (!empty($form)):


            echo $form;

        endif;

        ?>

        <div class="col-md-12">
            <?php
            if (!empty($materiais)):
                ?>
                <div class="table-responsive">
                    <table class="table table-bordered responsive">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Material</th>
                            <th>Quantidade</th>
                            <th>Início</th>
                            <th>Término</th>
                            <th>Data Cadastro</th>
                            <th>Opção</th>
                        </tr>
                        </thead>
                        <?php
                        if (!empty($materiais)):
                            $totalProd = 0;
                            foreach ($materiais as $material):
                                ?>
                                <tr>
                                    <td scope="row"><?= $material['id_estoque_caixa']; ?></td>
                                    <td><?= $material['nome_tipo_material']; ?></td>
                                    <td><?= $material['quant_estoque_caixa']; ?></td>
                                    <td><?= $material['inicio_estoque_caixa']; ?></td>
                                    <td><?= $material['fim_estoque_caixa']; ?></td>
                                    <td><?= $material['data_cadastro_estoque_caixa']; ?></td>
                                    <td>
                                        <a class="btn btn-warning btn-xs" href="<?= base_url('editar-funcionario/' . $material['id_estoque_caixa']) ?>">Visualizar</a>
                                        <button class="btn btn-danger btn-xs confirma_exclusao" href="#" data-id="<?= $material['id_estoque_caixa'] ?>" data-nome="<?= $material['id_estoque_caixa'] ?>">Deletar</button>
                                    </td>
                                </tr>
                                <?php
                                $totalProd = $material['quant_estoque_caixa'] + $totalProd;
                            endforeach;
                            ?>
                            <tr>
                                <td colspan="2">Total:</td>
                                <td colspan="1"><?= $totalProd ?></td>
                                <td colspan="7"></td>
                            </tr>
                            <?php
                        endif;
                        ?>
                    </table>
                </div>
                <?php
            endif;
            ?>
        </div>

        <div class="form-group col-md-6">
            <button type="submit" class="btn btn-primary btn-block cadastrar">Finalizar entrada</button>
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

<script>
    $("#tipo_material").change(function () {

        $("#seleciona_material").submit();
    })
</script>
