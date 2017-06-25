<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Usuário
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="<?= base_url('usuario') ?>">Usuários</a>
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
                <div class="panel-heading">Dados do usuário</div>
                <div class="panel-body">
                    <p><strong>Nome: </strong><?= $usuario[0]['nome_usuario'] ?></p>
                    <p><strong>RG: </strong><?= $usuario[0]['rg_usuario'] ?></p>
                    <p><strong>CPF: </strong><?= $usuario[0]['cpf_usuario'] ?></p>
                    <p><strong>E-mail: </strong><?= $usuario[0]['email_usuario'] ?></p>
                    <p><strong>Matrícula Sanear: </strong><?= $usuario[0]['matricula_usuario'] ?></p>
                    <p><strong>Perfil: </strong><?= $usuario[0]['nome_perfil'] ?></p>
                    <p><strong>Status: </strong><?= ucfirst($usuario[0]['status_usuario']) ?></p>
                    <p><strong>Data cadastro: </strong>
                        <?php
                        if (isset($usuario[0]['data_cad_usuario'])):
                            echo date('d/m/Y H:i', strtotime($usuario[0]['data_cad_usuario']));
                        endif;
                        ?>
                    </p>
                    <p><strong>Data atualização: </strong>
                        <?php
                        if (isset($usuario[0]['data_atualizacao_usuario'])):
                            echo date('d/m/Y H:i', strtotime($usuario[0]['data_atualizacao_usuario']));
                        endif;
                        ?>

                    </p>
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