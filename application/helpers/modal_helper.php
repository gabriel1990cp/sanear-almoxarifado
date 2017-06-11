<?php

function open_modal($mensagem_modal,$classe_modal)
{
    $return = array(
        'resultado_modal'  => TRUE,
        'mensagem_modal'     => $mensagem_modal,
        'classe_modal' => $classe_modal
    );
    return $return;
}



