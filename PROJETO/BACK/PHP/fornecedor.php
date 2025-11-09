<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/FABRIKA-SQ-17/PROJETO/BACK/PHP/banco.php';

    class Fornecedor{
        public $id_fornecedor;
        public $nome;
        public $razao_social;
        public $cnpj;

        function __construct($nome, $razao_social, $cnpj){
            $this->nome = $nome;
            $this->razao_social =  $razao_social;
            $this->cnpj = $cnpj;
        }

        function inserir(){
            $banco = new Banco();
            $conn = $banco->conectar();
            try{
                $stmt = $conn->prepare("INSERT INTO fornecedor (nome, razao_social, cnpj) VALUES (:nome, :razao_social, :cnpj)");
                $stmt->bindParam(':nome',$this->nome);
                $stmt->bindParam(':razao_social',$this->razao_social);
                $stmt->bindParam(':cnpj',$this->cnpj);
                $result = $stmt->execute();
            }catch(PDOException $e){
                echo $e->getMessage();
                $result = false;
            }

            $banco->fecharConexao();
            return $result;
        }

       
        public function editar(){
            if (empty($this->id_fornecedor)) {
                return false;
            }

            $banco = new Banco();
            $conn = $banco->conectar();

            try {
                

                $stmt = $conn->prepare("UPDATE fornecedor SET nome = :nome, razao_social = :razao_social, cnpj = :cnpj WHERE id_fornecedor = :id_fornecedor");
                $stmt->bindParam(':nome', $this->nome);
                $stmt->bindParam(':razao_social', $this->razao_social);
                $stmt->bindParam(':cnpj', $this->cnpj);
                $stmt->bindParam(':id_fornecedor', $this->id_fornecedor, PDO::PARAM_INT);

                $result = $stmt->execute();
            } catch (PDOException $e) {
                echo "Erro ao atualizar fornecedor: " . $e->getMessage();
                $result = false;
            }

            $banco->fecharConexao();
            return $result;
        }

        public function deletar(){
            if (empty($this->id_fornecedor)) {
                return false;
            }

            $banco = new Banco();
            $conn = $banco->conectar();

            try {
                $stmt = $conn->prepare("DELETE FROM fornecedor WHERE id_fornecedor = :id_fornecedor");
                $stmt->bindParam(':id_fornecedor', $this->id_fornecedor, PDO::PARAM_INT);

                $result = $stmt->execute();

               
            } catch (PDOException $e) {
                echo "Erro ao deletar fornecedor: " . $e->getMessage();
                $result = false;
            }

            $banco->fecharConexao();
            return $result;
        }

        function getIdFornecedor(){
            return $this->id_fornecedor;
        }

        function setIdFornecedor($id_fornecedor){
            $this->id_fornecedor = $id_fornecedor;
        }
    }
?>
