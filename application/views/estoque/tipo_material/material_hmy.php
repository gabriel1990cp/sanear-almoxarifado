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
                    <form action="<?= base_url('cadastrar-hmy') ?>" method="post" enctype="multipart/form-data" id="seleciona_material_hmy" class="seleciona_material_hmy">
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
                                <button type="submit" class="btn btn-primary btn-block cadastrar-hmy" id="btn-hm-y">Adicionar</button>
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
                                    <td scope="row"><?= $material['id_est_caixa_hmy']; ?></td>
                                    <td><?= $material['nome_tipo_material']; ?></td>
                                    <td><?= $material['quant_est_caixa_hmy']; ?></td>
                                    <td><?= $material['inicio_est_caixa_hmy']; ?></td>
                                    <td><?= $material['fim_est_caixa_hmy']; ?></td>
                                    <td><?= date('d/m/Y H:i', strtotime($material['data_cad_est_caixa_hmy']))?></td>
                                    <td>
                                        <a class="btn btn-warning btn-xs visualizar-hmy" data-caixa_hm="<?= $material['id_est_caixa_hmy'] ?>">Visualizar</a>
                                        <button class="btn btn-danger btn-xs confirma_exclusao" href="#" data-entrada="<?= $idEntradaMaterial ?>"  data-material="<?= $idMaterial ?>"  data-id="<?= $material['id_est_caixa_hmy'] ?>" data-nome="<?= $material['id_est_caixa_hmy'] ?>">Deletar</button>
                                    </td>
                                </tr>
                                <?php
                                $totalProd = $material['quant_est_caixa_hmy'] + $totalProd;
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

<script src="<?= base_url('assets/js/front/estoque.js') ?>"></script>

<!-- MODAL -->
<div class="modal fade" id="modal_confirmation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    &times;</span></button>
                <h4 class="modal-title">Confirmação de Exclusão</h4>
            </div>
            <div class="modal-body">
                <p>Deseja realmente excluir a caixa de hidrômetro : <strong><span id="nome_exclusao"></span></strong> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                <button type="button" class="btn btn-danger" id="btn_excluir">Sim</button>
            </div>
        </div>
    </div>
</div>
<!-- MODAL -->

<!-- MODAL -->
<div class="modal fade" id="visualizar-hmy">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    &times;</span></button>
                <h4 class="modal-title">Hidrômetros cadastrados</h4>
            </div>
            <div class="modal-body ">
                <div class="resultado"></div>
            </div>
        </div>
    </div>
</div>
<!-- MODAL -->