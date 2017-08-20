<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Entrada de Material
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="<?= base_url('#') ?>">Estoque</a>
                </li>
                <li class="active">
                    <i class="fa fa-table"></i><a href="<?= base_url('entrada-material/' . $idEntradaMaterial) ?>">Entrada de Material</a>
                </li>
            </ol>
        </div>
    </div>
    <?php $this->load->view('include/alert.php'); ?>
    <?php
    echo $infoEntradaMaterial;
    ?>
    <div class="col-md-12">
        <div class="row">
            <div class="panel panel-info">
                <div class="panel-heading">Cadastrar caixa de hidrômetro</div>
                <div class="panel-body">
                    <form action="<?= base_url('estoque/entrada_estoque_cxhm') ?>" method="post" enctype="multipart/form-data" id="seleciona_material" class="seleciona_material">
                        <input type="hidden" value="<?= $idEntradaMaterial ?>" name="idEntradaMaterial" id="idEntradaMaterial">
                        <input type="hidden" value="<?= $idMaterial ?>" name="idMaterial" id="idMaterial">
                        <div class="hm-y">
                            <div class="form-group col-md-4">
                                <label for="inicio_caixa_hm">Início caixa *</label>
                                <input type="text" class="form-control" id="inicio_caixa_hm" name="inicio_caixa_hm" placeholder="Exemplo:Y10L102030">
                                <div class="error error_inicio_caixa_hm"></div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="fim_caixa_hm">Fim caixa*</label>
                                <input type="text" class="form-control" id="fim_caixa_hm" name="fim_caixa_hm" placeholder="Exemplo:Y10L102040">
                                <div class="error error_fim_caixa_hm"></div>
                            </div>
                            <div class="form-group col-md-4">
                                <button type="submit" class="btn btn-primary btn-block cadastrar-hm" id="btn-hm-y">Adicionar</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row">
            <?php
            if (!empty($materiais)):
                ?>
                <p class="page-header title-table">
                    Hidrômetros cadastrados
                </p>
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
                                    <td><?= date('d/m/Y H:i', strtotime($material['data_cadastro_estoque_caixa']))?></td>
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
    </div>
</div>