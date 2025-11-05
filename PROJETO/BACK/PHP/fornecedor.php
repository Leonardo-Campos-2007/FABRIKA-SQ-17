<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/FABRIKA-SQ-17/PROJETO/BACK/PHP/banco.php'

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
                $stmt = $conn->prepare("insert into fornecedor (nome, razao_social, cnpj) values(:nome, :razao_social, 
                :cnpj");
                $stmt->bindParam(':nome',$this->nome);
                $stmt->bindParam(':razao_social',$this->razao_social);
                $stmt->bindParam(':cnpj',$this->cnpj);
                $stmt->execute();
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            $banco->fecharConexao();
        }

        function getIdFornecedor(){
            return $this->id_fornecedor;
        }

        
        function setIdFornecedor($id_fornecedor){
            $this->id_fornecedor = $id_fornecedor;
        }


    }


?>