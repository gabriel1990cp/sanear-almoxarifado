<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Estoque
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="<?= base_url('estoque') ?>">Estoque</a>
                </li>
                <li class="active">
                    <i class="fa fa-table"></i> Entrada em aberto
                </li>
            </ol>
        </div>
    </div>
    <?php

    $this->load->view('include/alert.php');

    echo $infoEntradaMaterial;

    ?>
    <div class="col-md-12">
        <div class="row">
            <div class="panel panel-info">
                <div class="panel-heading">Resumo da entrada</div>
                <div class="panel-body">
                    <?php
                    if ($totalMateriais[0]['totalHMA']) {
                        echo '<p> Hidrômetro A : ' . $totalMateriais[0]['totalHMA'] . '</p>';
                    }
                    if ($totalMateriais[0]['totalHMA']) {
                        echo '<p> Hidrômetro B : ' . $totalMateriais[0]['totalHMB'] . '</p>';
                    }
                    if ($totalMateriais[0]['totalHMC']) {
                        echo '<p> Hidrômetro C : ' . $totalMateriais[0]['totalHMC'] . '</p>';
                    }
                    if ($totalMateriais[0]['totalHMD']) {
                        echo '<p> Hidrômetro D : ' . $totalMateriais[0]['totalHMD'] . '</p>';
                    }
                    if ($totalMateriais[0]['totalHMY']) {
                        echo '<p> Hidrômetro Y : ' . $totalMateriais[0]['totalHMY'] . '</p>';
                    }
                    if ($totalMateriais[0]['totalHMY']) {
                        echo '<p> Caixa Hidrômetro Y : ' . $totalMateriais[0]['totalCaixaHMY'] . '</p>';
                    }
                    if ($totalMateriais[0]['totalLacre']) {
                        echo '<p> Lacre cordoalha de aço : ' . $totalMateriais[0]['totalLacre'] . '</p>';
                    }
                    if ($totalMateriais[0]['totalMola']) {
                        echo '<p> Mola dispositivo anti fraude : ' . $totalMateriais[0]['totalLacre'] . '</p>';
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="panel panel-info">
                <div class="panel-heading">Selecionar material</div>
                <div class="row">
                    <?php
                    if ($materiais):
                        foreach ($materiais as $material):
                            ?>
                            <div class="btn-material col-xs-6 col-md-3">
                                <p>
                                    <a class="btn btn-default btn-md"
                                       href="<?= base_url('selecionar-material/' . $idEntradaMaterial . '/' . $material['id_tipo_material']) ?>"><?= $material['nome_tipo_material'] ?></a>
                                </p>
                            </div>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <button class="btn btn-primary btn-block finalizar_entrada_estoque" data-id="<?= $idEntradaMaterial ?>"
                    data-nome="<?= $idEntradaMaterial ?>">Finalizar Entrada
            </button>
        </div>
        <div class="col-md-6">
            <a href="<?= base_url('estoque/') ?>" class="btn btn-danger btn-block">Cancelar Entrada</a>
        </div>
    </div>
</div>

<!-- MODAL -->
<div class="modal fade" id="modal_confirmation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Confirmação de Exclusão</h4>
            </div>
            <div class="modal-body">
                <p>Deseja realmente finalizar a entrada : <strong><span id="nome_exclusao"></span></strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                <button type="button" class="btn btn-primary" id="btn_finalizar">Sim</button>
            </div>
        </div>
    </div>
</div>
<!-- MODAL -->


<!-- SCRIPT -->
<script src="<?= base_url('assets/js/front/estoque.js') ?>"></script>
<!-- SCRIPT -->


