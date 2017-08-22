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
                    <i class="fa fa-table"></i>Entradas cadastradas
                </li>
            </ol>
        </div>
    </div>
    <?php $this->load->view('include/alert.php'); ?>
    <div class="row">
        <form action="<?= base_url('consultar-entrada') ?>" method="post" enctype="multipart/form-data" id="consultar_entrada"
              class="consulta_usuario">
            <div class="form-group col-md-12">
                <p>Digite o atendimento de requisição ou nota de remessa para realizar a consulta.</p>
            </div>
            <div class="form-group col-md-4">
                <input type="text" class="form-control" id="atendimento_requisicao" name="atendimento_requisicao" placeholder="Atendimento de Requisição" value="<?php if (!empty($atendimentoRequisicao)) : echo $atendimentoRequisicao; endif; ?>">
            </div>
            <div class="form-group col-md-4">
                <input type="text" class="form-control" id="nota_remessa" name="nota_remessa" placeholder="Nota de remessa" value="<?php if (!empty($notaRemessa)) : echo $notaRemessa; endif; ?>">
            </div>
            <div class="form-group col-md-2">
                <select class="form-control" id="status" name="status">
                    <option value="">Status</option>
                    <option value="aberto" <?php if (!empty($status)) : if ($status == "aberto") : echo "selected"; endif; endif; ?>>Aberto</option>
                        <option value="finalizado" <?php if (!empty($status)) : if ($status == "finalizado") : echo "selected"; endif; endif; ?>>Finalizado</option>
                </select>
            </div>
            <div class="form-group col-md-2">
                <button type="submit" class="btn btn-primary" id="btn_search">Consultar</button>
            </div>
            <div class="form-group col-md-12">
                <label id="atendimento_requisicao-error" class="error display-none" for="atendimento_requisicao">Ops, digite o atendimento de requisição ou a nota de remessa para realizar a consulta.</label>
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
                        <th>Responsável</th>
                        <th>Data de cadastro</th>
                        <th>Atendimento de Requisição</th>
                        <th>Nota de remessa</th>
                        <th>Arquivo</th>
                        <th>Status</th>
                        <th>Opção</th>
                    </tr>
                    </thead>
                    <?php
                    if (!empty($entradasEstoque)):
                        foreach ($entradasEstoque as $entradaEstoque):
                            ?>
                            <tr>
                                <td scope="row"><?= $entradaEstoque['id_entrada_est']; ?></td>
                                <td>Gabriel Costa</a></td>
                                <td><?= date('d/m/Y H:i', strtotime($entradaEstoque['data_entrada_est']))?></td>
                                <td><?= $entradaEstoque['atend_requisicao_entrada_est']; ?></td>
                                <td><?= $entradaEstoque['nota_remessa_entrada_est']; ?></td>
                                <td><a href="<?= base_url('uploads/') . $entradaEstoque['arquivo_entrada_est'] ?>" download=""><?= $entradaEstoque['arquivo_entrada_est']; ?></a></td>
                                <td><?= ucfirst($entradaEstoque['status_entrada_est']); ?></td>
                                <td>
                                    <a class="btn btn-primary btn-xs" href="<?= base_url('entrada-material/' . $entradaEstoque['id_entrada_est']) ?>">Material</a>
                                    <a class="btn btn-warning btn-xs" href="<?= base_url('editar-funcionario/' . $entradaEstoque['id_entrada_est']) ?>">Editar</a>
                                    <button class="btn btn-danger btn-xs confirma_exclusao" href="#" data-id="<?= $entradaEstoque['id_entrada_est'] ?>" data-nome="<?= $entradaEstoque['id_entrada_est'] ?>">Deletar</button>
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
<script src="<?= base_url('assets/js/front/estoque.js') ?>"></script>
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