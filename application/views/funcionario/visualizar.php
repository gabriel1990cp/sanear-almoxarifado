<?php
echo "<pre>";
var_dump($funcionario[0]);
echo "</pre>";
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Funcionários
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="<?= base_url('funcionario  ') ?>">Funcionários</a>
                </li>
                <li class="active">
                    <i class="fa fa-table"></i> Visualizar
                </li>
            </ol>
        </div>
    </div>
    <?php $this->load->view('include/alert.php'); ?>
    <div class="col-md-12">
        <div class="row">
            <div class="panel panel-info">
                <div class="panel-heading">Dados equipe</div>
                <div class="panel-body">
                    <p><strong>Nome: </strong><?= $funcionario[0]['nome_funcionario'] ?></p>
                    <p><strong>RG: </strong><?= $funcionario[0]['rg_funcionario'] ?></p>
                    <p><strong>CPF: </strong><?= $funcionario[0]['nome_funcionario'] ?></p>
                    <p><strong>Cargo: </strong><?= $funcionario[0]['nome_funcionario'] ?></p>
                    <p><strong>Carro: </strong><?= $funcionario[0]['nome_funcionario'] ?></p>
                    <p><strong>Telefone: </strong><?= $funcionario[0]['nome_funcionario'] ?></p>
                    <p><strong>Celular: </strong><?= $funcionario[0]['nome_funcionario'] ?></p>
                    <p><strong>Status: </strong><?= $funcionario[0]['nome_funcionario'] ?></p>
                    <p><strong>Observação: </strong><?= $funcionario[0]['nome_funcionario'] ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script src="<?= base_url('assets/js/jquery.validate.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.maskedinput.js') ?>"></script>
<script src="<?= base_url('assets/js/front/funcionario.js') ?>"></script>
<!-- SCRIPT -->