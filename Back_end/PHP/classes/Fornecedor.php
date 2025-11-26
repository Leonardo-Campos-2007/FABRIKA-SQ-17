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

    // ----------- DELETAR DO BANCO -----------
    public function deletarFornecedor($conn) {
        try {
            if (empty($this->fornecedor_id)) {
                echo "❌ ID do fornecedor não informado.";
                return false;
            }

            $sql = "DELETE FROM fornecedor WHERE fornecedor_id = :fornecedor_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':fornecedor_id', $this->fornecedor_id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    echo "✅ Fornecedor removido com sucesso!";
                    return true;
                } else {
                    echo "⚠️ Nenhum fornecedor encontrado com o ID informado.";
                    return false;
                }
            } else {
                echo "❌ Erro ao deletar fornecedor.";
                return false;
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }

    // ----------- EDITAR NO BANCO -----------
    public function editarFornecedor($conn) {
        try {
            if (empty($this->fornecedor_id)) {
                echo "❌ ID do fornecedor não informado.";
                return false;
            }

            $sql = "UPDATE fornecedor SET
                        nome_fornecedor = :nome_fornecedor,
                        razao_social = :razao_social,
                        cnpj = :cnpj
                    WHERE fornecedor_id = :fornecedor_id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nome_fornecedor', $this->nome_fornecedor);
            $stmt->bindParam(':razao_social', $this->razao_social);
            $stmt->bindParam(':cnpj', $this->cnpj);
            $stmt->bindParam(':fornecedor_id', $this->fornecedor_id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    echo "✅ Fornecedor atualizado com sucesso!";
                    return true;
                } else {
                    echo "⚠️ Nenhuma alteração detectada ou fornecedor não encontrado.";
                    return false;
                }
            } else {
                echo "❌ Erro ao atualizar fornecedor.";
                return false;
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }
    }

}

?>
