<?php

class cerigrafia{
    public $id_cerigrafia;
    public $tamanho;
    public $cor;
}

function __construct($tamanho, $cor){
    $this->tamanho = $tamanho;
    $this->cor =  $cor;
    
}