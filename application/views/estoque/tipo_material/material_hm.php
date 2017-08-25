<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Entrada de Material - <small><?= $nomeMaterial[0]['nome_tipo_material']?></small>
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
                <div class="panel-heading">Cadastro de hidrômetro avulso</div>
                <div class="panel-body">
                    <form action="<?= base_url('cadastrar-hm') ?>" method="post" enctype="multipart/form-data" id="seleciona_material_hm" class="seleciona_material_hm">
                        <input type="hidden" value="<?= $idEntradaMaterial ?>" name="idEntradaMaterial" id="idEntradaMaterial">
                        <input type="hidden" value="<?= $idMaterial ?>" name="idMaterial" id="idMaterial">
                        <div class="hm-y">
                            <div class="form-group col-md-8">
                                <label for="inicio_caixa_hm">Hidrômetro *</label>
                                <input type="text" class="form-control" id="hm_avulso" name="hm_avulso" placeholder="Exemplo:X10L102030">
                                <div class="error error_hm_avulso"></div>
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
                            <th>Hidrômetro</th>
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
                                    <td scope="row"><?= $material['id_est_hm_avulso']; ?></td>
                                    <td><?= $material['nome_tipo_material']; ?></td>
                                    <td><?= $material['numero_est_hm_avulso']; ?></td>
                                    <td><?= date('d/m/Y H:i', strtotime($material['data_cad_est_hm_avulso']))?></td>
                                    <td>
                                        <button class="btn btn-danger btn-xs confirma_exclusao_hm_avulso" href="#" data-entrada="<?= $idEntradaMaterial ?>"  data-material="<?= $idMaterial ?>"  data-id="<?= $material['id_est_hm_avulso'] ?>" data-nome="<?= $material['id_est_hm_avulso'] ?>">Deletar</button>
                                    </td>
                                </tr>
                                <?php
                                $totalProd = 1 + $totalProd;
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

