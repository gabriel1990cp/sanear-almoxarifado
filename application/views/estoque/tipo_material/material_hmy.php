<form action="<?= base_url('estoque/entrada_estoque_cxhm') ?>" method="post" enctype="multipart/form-data" id="seleciona_material" class="seleciona_material">
    <div class="hm-y">
        <div class="form-group col-md-4">
            <label for="inicio_caixa_hm">Início caixa *</label>
            <input type="text" class="form-control" id="inicio_caixa_hm" name="inicio_caixa_hm" placeholder="Exemplo:Y10l102030">
            <div class="error error_inicio_caixa_hm"></div>
        </div>
        <div class="form-group col-md-4">
            <label for="fim_caixa_hm">Fim caixa*</label>
            <input type="text" class="form-control" id="fim_caixa_hm" name="fim_caixa_hm" placeholder="Exemplo:Y10l102040">
            <div class="error error_fim_caixa_hm"></div>
        </div>
        <div class="form-group col-md-4">
            <button type="submit" class="btn btn-primary btn-block cadastrar-hm" id="btn-hm-y">Adicionar</button>
        </div>
    </div>
</form>