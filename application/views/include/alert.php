<?php
if ($this->session->flashdata('resultado_modal')) { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert <?= $this->session->flashdata('classe_modal') ?> alert-dismissable fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?= $this->session->flashdata('mensagem_modal') ?>
            </div>
        </div>
    </div>
<?php } ?>