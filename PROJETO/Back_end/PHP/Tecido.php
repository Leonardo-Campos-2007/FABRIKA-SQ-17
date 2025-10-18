<?php

class Tecido {
    private $tecido_id;
    private $nome_tecido;
    private $cor;
    private $peso_metros;
    private $composicao;
    private $gramatura;
    private $fornecedor_id;

     function __construct($tecido_id, $nome_tecido, $cor, $peso_metros, $composicao, $gramatura, $fornecedor_id) {
        $this->tecido_id = $tecido_id;
        $this->nome_tecido = $nome_tecido;
        $this->cor = $cor;
        $this->peso_metros = $peso_metros;
        $this->composicao = $composicao;
        $this->gramatura = $gramatura;
        $this->fornecedor_id = $fornecedor_id;
    }

}