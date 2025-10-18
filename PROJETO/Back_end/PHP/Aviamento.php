<?php

class Aviamento {
    private $aviamento_id;
    private $tipo_aviamento;
    private $cor;
    private $peso_quantidade;
    private $composicao;

    function __construct($aviamento_id, $tipo_aviamento, $cor, $peso_quantidade, $composicao) {
        $this->aviamento_id = $aviamento_id;
        $this->tipo_aviamento = $tipo_aviamento;
        $this->cor = $cor;
        $this->peso_quantidade = $peso_quantidade;
        $this->composicao = $composicao;
    }

}