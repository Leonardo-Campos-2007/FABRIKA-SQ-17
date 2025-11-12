<?php

class FichaTecnica
{
    public $id_ficha_tecnica;
    public $id_modelagem;
    public $id_tecido;
    public $id_cerigrafia;
    public $id_aviamento;
    public $id_beneficiamento;

    function __construct($id_modelagem, $id_tecido, $id_cerigrafia, $id_aviamento, $id_beneficiamento)
    {
        $this->id_modelagem = $id_modelagem;
        $this->id_tecido =  $id_tecido;
        $this->id_cerigrafia = $id_cerigrafia;
        $this->id_aviamento = $id_aviamento;
        $this->id_beneficiamento = $id_beneficiamento;
    }
}

function juntarFichaTecnica()
{
}