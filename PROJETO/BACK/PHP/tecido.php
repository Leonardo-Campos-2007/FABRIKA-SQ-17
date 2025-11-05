<?php
    include_once 'BANCO/banco.php';


    class Tecido{
        public $id_tecido;
        public $nome_tecido;
        public $cor;
        public $peso_metro;
        public $composicao;
        public $tamanho;
        public $id_fornecedor;

        function __construct($nome, $cor, $peso_metro, $composicao, $tamanho, $id_fornecedor){
            $this->nome = $nome;
            $this->cor =  $cor;
            $this->peso_metro = $peso_metro;
            $this->composicao = $composicao;
            $this->id_fornecedor = $id_fornecedor;
        }

        function inserir(){
            $banco = new Banco();
            $conn = $banco->conectar();
            try{
                $stmt = $conn->prepare("insert into tecido (nome, cor, peso_metro, composicao, id_fornecedor) values(:nome, :cor, :peso_metro, 
                :composicao, :id_fornecedor)");
                $stmt->bindParam(':nome',$this->nome);
                $stmt->bindParam(':cor',$this->cor);
                $stmt->bindParam(':peso_metro',$this->peso_metro);
                $stmt->bindParam(':composicao',$this->composicao);
                $stmt->bindParam(':id_fornecedor',$this->id_fornecedor);
                
                $result = $stmt->execute();
                $banco->fecharConexao();

                return $result;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function getIdTecido(){
            return $this->id_tecido;
        }

        function setIdTecido($id_tecido){
            $this->id_tecido = $id_tecido;
        }

        static function carregar($id_tecido){
            try{
                $banco = new Banco();
                $conn = $banco->conectar();
                $stmt = $conn->prepare("select * from tecido where id_tecido = :id_tecido");
                $stmt->bindParam(':id_tecido',$id_tecido);
                $stmt->execute();
                $tecido = null;
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                foreach($stmt->fetchAll() as $v => $value){
                    $tecido = new Tecido($value['nome'], $value['cor'], $value['peso_metro'], $value['composicao'], $value['id_fornecedor']);
                    $tecido->setIdTecido( $value['id_tecido']);
                }
                return $tecido;

            }catch(PDOException $e){
                echo "Erro " . $e->getMessage();
            }
        }
    }
?>