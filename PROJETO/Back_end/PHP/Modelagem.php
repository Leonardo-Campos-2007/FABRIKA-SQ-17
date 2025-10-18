<?php

class Modelagem {
    private $modelagem_id;
    private $tipo_molde;
    private $codigo_molde;

    function __construct($modelagem_id, $tipo_molde, $codigo_molde) {
        $this->modelagem_id = $modelagem_id;
        $this->tipo_molde = $tipo_molde;
        $this->codigo_molde = $codigo_molde;
    }

}