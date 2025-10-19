<?php

class Fornecedor {

    private $fornecedor_id;
    private $nome_fornecedor;
    private $razao_social;
    private $cnpj;

    
    public function __construct($fornecedor_id, $nome_fornecedor, $razao_social, $cnpj) {
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

    // ----------- INSERIR NO BANCO -----------
    public function inserirFornecedor($conn) {
        try {
            $sql = "INSERT INTO fornecedor (nome_fornecedor, razao_social, cnpj) 
                    VALUES (:nome_fornecedor, :razao_social, :cnpj)";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nome_fornecedor', $this->nome_fornecedor);
            $stmt->bindParam(':razao_social', $this->razao_social);
            $stmt->bindParam(':cnpj', $this->cnpj);

            if ($stmt->execute()) {
                echo "✅ Fornecedor cadastrado com sucesso!";
            } else {
                echo "❌ Erro ao cadastrar fornecedor.";
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

}

?>
