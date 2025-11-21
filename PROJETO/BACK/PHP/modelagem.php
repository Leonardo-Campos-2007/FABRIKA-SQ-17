<?php
    include_once 'BANCO/banco.php';


    class Modelagem{
        public $id_modelagem;
        public $tipo_molde;
        public $codigo_molde;
        public $tamanho;

        function __construct($tipo_molde, $codigo_molde, $tamanho){
            $this->tipo_molde = $tipo_molde;
            $this->codigo_molde =  $codigo_molde;
            $this->tamanho = $tamanho;  
        }

        function inserir(){
            $banco = new Banco();
            $conn = $banco->conectar();
            try{
                $stmt = $conn->prepare("insert into modelagem (tipo_molde, codigo_molde, tamanho) values(:tipo_molde, :codigo_molde, :tamanho)");
                $stmt->bindParam(':tipo_molde',$this->tipo_molde);
                $stmt->bindParam(':codigo_molde',$this->codigo_molde);
                $stmt->bindParam(':tamanho',$this->tamanho);
                
                $result = $stmt->execute();
                $banco->fecharConexao();

                return $result;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function getIdModelagem(){
            return $this->id_modelagem;
        }

        function setIdModelagem($id_modelagem){
            $this->id_modelagem = $id_modelagem;
        }

        static function carregar($id_modelagem){
            try{
                $banco = new Banco();
                $conn = $banco->conectar();
                $stmt = $conn->prepare("select * from modelagem where id_modelagem = :id_modelagem");
                $stmt->bindParam(':id_modelagem',$id_modelagem);
                $stmt->execute();
                $modelagem = null;
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                foreach($stmt->fetchAll() as $v => $value){
                    $modelagem = new Modelagem($value['tipo_molde'], $value['codigo_molde'], $value['tamanho']);
                    $modelagem->setIdModelagem( $value['id_modelagem']);
                }
                return $modelagem;

            }catch(PDOException $e){
                echo "Erro " . $e->getMessage();
            }
        }
    }
?>