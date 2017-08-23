<div class="col-md-12">
    <div class="row">
        <div class="panel panel-info">
            <div class="panel-heading">Dados da entrada</div>
            <div class="panel-body">
                <p>Responsável: Gabriel Costa Pinto</p>
                <p>Data de cadastro: <?= date('d/m/Y H:i', strtotime($infoEntradaMaterialView[0]['data_est_entrada']))?></p>
                <p>Atendimento de Requisição: <?=$infoEntradaMaterialView[0]['atend_requisicao_est_entrada']?></p>
                <p>Nota de remessa: <?=$infoEntradaMaterialView[0]['nota_remessa_est_entrada']?></p>
                <p>Arquivo: <a href="<?= base_url('uploads/'). $infoEntradaMaterialView[0]['arquivo_est_entrada'] ?>" download=""><?= $infoEntradaMaterialView[0]['arquivo_est_entrada'];?></a></p>
                <p>Status: <?= ucfirst($infoEntradaMaterialView[0]['status_est_entrada'])?></p>
            </div>
        </div>
    </div>
</div>