<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Usúarios
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="<?= base_url('usuario') ?>">Usúarios</a>
                </li>
                <li class="active">
                    <i class="fa fa-table"></i>Usúarios cadastrados
                </li>
            </ol>
        </div>
    </div>
    <?php $this->load->view('include/alert.php'); ?>
    <div class="row">
        <form action="<?= base_url('consultar-usuario') ?>" method="post" enctype="multipart/form-data" id="consulta_usuario"
              class="consulta_usuario">
            <div class="form-group col-md-12">
                <p>Digite o nome ou CPF para realizar a consulta.</p>
            </div>
            <div class="form-group col-md-6">
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?php if (!empty($nome)) : echo $nome; endif; ?>">
                <label id="nome-error" class="error display-none" for="nome">Ops, digite o nome ou CPF para realizar a consulta.</label>
            </div>
            <div class="form-group col-md-2">
                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" value="<?php if (!empty($cpf)) : echo $cpf; endif; ?>">
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
                        <th>RG</th>
                        <th>CPF</th>
                        <th>E-mail</th>
                        <th>Matrícula Sabesp</th>
                        <th>Perfil</th>
                        <th>Status</th>
                        <th>Opção</th>
                    </tr>
                    </thead>
                    <?php
                    if (!empty($usuarios)):
                        foreach ($usuarios as $usuario):
                            ?>
                            <tr>
                                <td scope="row"><?= $usuario['id_usuario']; ?></td>
                                <td><a href="<?= base_url('visualizar-usuario/' . $usuario['id_usuario']) ?>"><?= $usuario['nome_usuario']; ?></a></td>
                                <td><?= $usuario['rg_usuario']; ?></td>
                                <td><?= $usuario['cpf_usuario']; ?></td>
                                <td><?= $usuario['email_usuario']; ?></td>
                                <td><?= $usuario['matricula_usuario']; ?></td>
                                <td><?= $usuario['nome_perfil']; ?></td>
                                <td><?= ucfirst($usuario['status_usuario']); ?></td>
                                <td>
                                    <a class="btn btn-warning btn-xs" href="<?= base_url('editar-usuario/' . $usuario['id_usuario']) ?>">Editar</a>
                                    <?php
                                    if ($usuario['status_usuario'] != "inativo"):
                                        ?>
                                        <button class="btn btn-danger btn-xs confirma_exclusao" href="#" data-id="<?= $usuario['id_usuario'] ?>" data-nome="<?= $usuario['nome_usuario'] ?>">Deletar</button>
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
                            <td colspan="9">Não há registros para exibir.</td>
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
<script src="<?= base_url('assets/js/front/usuario.js') ?>"></script>
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
                <p>Deseja realmente excluir o usúario : <strong><span id="nome_exclusao"></span></strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                <button type="button" class="btn btn-danger" id="btn_excluir">Sim</button>
            </div>
        </div>
    </div>
</div>
<!-- MODAL -->