<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Equipes
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="<?= base_url('equipes') ?>">Equipes</a>
                </li>
                <li class="active">
                    <i class="fa fa-table"></i>Equipes cadastradas
                </li>
            </ol>
        </div>
    </div>
    <?php $this->load->view('include/alert.php'); ?>
    <div class="row">
        <form action="<?= base_url('consultar-equipe') ?>" method="post" enctype="multipart/form-data" id="consulta_equipe"
              class="consulta_equipe">
            <div class="form-group col-md-12">
                <p>Digite o nome ou tipo de equipe para realizar a consulta.</p>
            </div>
            <div class="form-group col-md-6">
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?php if (!empty($nome)) : echo $nome; endif; ?>">
                <label id="erro-busca-error" class="error display-none" for="nome">Ops, digite o nome ou tipo de equipe para realizar a consulta.</label>
            </div>
            <div class="form-group col-md-2">
                <select class="form-control" id="tipo_equipe" name="tipo_equipe">
                    <option value="">Tipo de equipe</option>
                    <?php
                    foreach ($tipoEquipes as $tipoEquipe):
                        ?>
                        <option value="<?= $tipoEquipe['id_tipo_equipe'] ?>" <?php if (!empty($tipo_equipe)) : if ($tipo_equipe == $tipoEquipe['id_tipo_equipe']) : echo "selected"; endif; endif; ?>><?= $tipoEquipe['nome_tipo_equipe'] ?></option>
                        <?php
                    endforeach;
                    ?>
                </select>
            </div>
            <div class="form-group col-md-2">
                <select class="form-control" id="status" name="status">
                    <option value="">Status</option>
                    <option value="ativo" <?php if (!empty($status)) : if ($status == "ativo") : echo "selected"; endif; endif; ?>>Ativo</option>
                    <option value="inativo" <?php if (!empty($status)) : if ($status == "inativo") : echo "selected"; endif; endif; ?>>Inativo</option>
                </select>
            </div>
            <div class="form-group col-md-2">
                <button type="submit" class="btn btn-primary" id="btn_search">Consultar</button>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered responsive">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Inspetor</th>
                        <th>Encanador</th>
                        <th>Observação</th>
                        <th>Tipo</th>
                        <th>Status</th>
                        <th>Opção</th>
                    </tr>
                    </thead>
                    <?php
                    if (!empty($equipes)):
                        foreach ($equipes as $equipe):
                            ?>
                            <tr>
                                <td scope="row"><?= $equipe['id_equipe']; ?></td>
                                <td><?= $equipe['nome_equipe']; ?></td>
                                <td><?= $equipe['nome_funcionario']; ?></td>
                                <td><?= $equipe['nome_funcionario']; ?></td>
                                <td><?= $equipe['observacao_equipe']; ?></td>
                                <td><?= $equipe['nome_tipo_equipe']; ?></td>
                                <td><?= ucfirst($equipe['status_equipe']); ?></td>
                                <td>
                                    <a class="btn btn-default btn-xs" href="<?= base_url('gerenciar-equipe/' . $equipe['id_equipe']) ?>">Gerenciar</a>
                                    <a class="btn btn-warning btn-xs" href="<?= base_url('editar-equipe/' . $equipe['id_equipe']) ?>">Editar</a>
                                    <?php
                                    if ($equipe['status_equipe'] != "inativo"):
                                        ?>
                                        <button class="btn btn-danger btn-xs confirma_exclusao" href="#" data-id="<?= $equipe['id_equipe'] ?>" data-nome="<?= $equipe['nome_equipe'] ?>">Deletar</button>
                                        <?php
                                    endif;
                                    ?>
                                </td>
                            </tr>
                            <?php
                        endforeach;
                    else:
                        ?>
                        <tr>
                            <td colspan="10">Não há registros para exibir.</td>
                        </tr>
                        <?php
                    endif;
                    ?>
                </table>
            </div>
        </div>
    </div>
    <?php
    if (!empty($paginador)):
        ?>
        <div class="row">
            <div class="col-md-12">
                <ul class="pagination">
                    <?= $paginador ?>
                </ul>
            </div>
        </div>
        <?php
    endif;
    ?>
</div>

<!-- SCRIPT -->
<script src="<?= base_url('assets/js/front/equipe.js') ?>"></script>
<!-- SCRIPT -->

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
                <p>Deseja realmente excluir o funcionários : <strong><span id="nome_exclusao"></span></strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                <button type="button" class="btn btn-danger" id="btn_excluir">Sim</button>
            </div>
        </div>
    </div>
</div>
<!-- MODAL -->