<?php

Class Fornecedor {

    private $fornecedor_id;
    private $nome_fornecedor;
    private $razao_social;
    private $cnpj;

    funcion __construct($fornecedor_id, $nome_fornecedor, $razao_social, $cnpj) {
        $this->fornecedor_id = $fornecedor_id;
        $this->nome_fornecedor = $nome_fornecedor;
        $this->razao_social = $razao_social;
        $this->cnpj = $cnpj;
    }  
    
    // ----------- GETTERS -----------

    public function getFornecedorId() {
        return $this->fornecedor_id;
    }

    public function getNomeFornecedor() {
        return $this->nome_fornecedor;
    }

    public function getRazaoSocial() {
        return $this->razao_social;
    }

    public function getCnpj() {
        return $this->cnpj;
    }

    // ----------- SETTERS -----------

    public function setFornecedorId($fornecedor_id) {
        $this->fornecedor_id = $fornecedor_id;
    }

    public function setNomeFornecedor($nome_fornecedor) {
        $this->nome_fornecedor = $nome_fornecedor;
    }

    public function setRazaoSocial($razao_social) {
        $this->razao_social = $razao_social;
    }

    public function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    

}