<?php

class Beneficiamento {

    private $beneficiamento_id;
    private $digital;
    private $bordado;
    private $sublimacao;
    private $serigrafia;

    function __construct($beneficiamento_id, $digital, $bordado, $sublimacao, $serigrafia) {
        $this->beneficiamento_id = $beneficiamento_id;
        $this->digital = $digital;
        $this->bordado = $bordado;
        $this->sublimacao = $sublimacao;
        $this->serigrafia = $serigrafia;
    }

}