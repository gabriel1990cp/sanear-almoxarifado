<div class="container">
    <div class="col-md-12">
        <div class="row">
            <h1 class="page-header">
                Gerenciar equipe
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="<?= base_url('equipes') ?>">Equipes</a>
                </li>
                <li class="active">
                    <i class="fa fa-table"></i>Gerenciar equipe
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
                    <p><strong>Nome da equipe: </strong><?= $equipe[0]['nome_equipe'] ?></p>
                    <p><strong>Inspetor: </strong><?= $equipe[0]['nome_funcionario'] ?></p>
                    <p><strong>Tipo Equipe: </strong><?= $equipe[0]['nome_tipo_equipe'] ?></p>
                    <p><strong>Status: </strong><?= ucfirst($equipe[0]['status_equipe']) ?></p>
                    <p><strong>Observação: </strong><?= $equipe[0]['observacao_equipe'] ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Cadastrar Encanador</div>
                <div class="panel-body">
                    <form action="<?= base_url('equipe/insert_manager_team') ?>" method="post" enctype="multipart/form-data" id="cadastro_encanador" class="cadastrar-encanador">
                        <div class="col-md-6">
                            <label>Selecione um encanador para adicioná-lo a equipe: <?= $equipe[0]['nome_equipe'] ?></label>
                            <div class="input-group">
                                <input id="encanador" name="encanador" type="text" class="col-md-6 form-control" placeholder="Selecionar encanador" autocomplete="off"/>
                                <input type="hidden" value="" name="resultado-encanador" id="resultado-encanador">
                                <input type="hidden" value="<?= $equipe[0]['id_equipe'] ?>" name="equipe" id="equipe">
                                <span class="input-group-btn"><button class="btn btn-default inserir" type="button">Inserir</button></span>
                            </div>
                            <span class="validacao-encanador error">O campo encanador é obrigatório!</span>
                        </div>
                    </form>

                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table table-bordered responsive">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Ação</th>
                                </tr>
                                </thead>
                                <?php
                                if (!empty($encanadores)):
                                    foreach ($encanadores as $encanador):
                                        ?>
                                        <tr>
                                            <td scope="row"><?= $encanador['id_funcionario']; ?></td>
                                            <td><?= $encanador['nome_funcionario']; ?></td>
                                            <td>
                                                <button class="btn btn-danger btn-xs confirma_exclusao" href="#"  data-equipe="<?= $equipe[0]['id_equipe']?>" data-id="<?= $encanador['id_funcionario'] ?>" data-nome="<?= $encanador['nome_funcionario'] ?>">Deletar</button>
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
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script src="<?= base_url('assets/js/front/gerenciar-equipe.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap-typeahead.min.js') ?>"></script>

<script>
    $(function () {

        function displayResult(item) {
            $('#resultado-encanador').val(item.value);
        }

        $('#encanador').typeahead({
            source: <?php echo json_encode($funcionarios) ?>,
            onSelect: displayResult
        });
    })
</script>
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
                <p>Deseja realmente excluir o encanador : <strong><span id="nome_exclusao"></span></strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                <button type="button" class="btn btn-danger" id="btn_excluir">Sim</button>
            </div>
        </div>
    </div>
</div>
<!-- MODAL -->