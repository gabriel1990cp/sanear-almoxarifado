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
                    foreach ($totalMateriaisEntrada as $materiaisEntrada):
                        foreach ($materiaisEntrada as $row):
                            if (!empty($row)):
                                if ($row['total'] == !0):
                                    echo '<p>' . $row['nome_tipo_material'] . ' : ' . $row['total'] . '</p>';
                                endif;
                            endif;
                        endforeach;
                    endforeach;
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
                                    <a class="btn btn-default btn-md" href="<?= base_url('estoque/select_material/' . $idEntradaMaterial . '/' . $material['id_tipo_material']) ?>"><?= $material['nome_tipo_material'] ?></a>
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
</div>

