<?php
    include_once 'BANCO/banco.php';


    class Tecido{
        public $id_tecido;
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
                $stmt = $conn->prepare("insert into tecido (tipo_molde, codigo_molde, tamanho) values(:tipo_molde, :codigo_molde, :tamanho)");
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
                    $tecido = new Tecido($value['tipo_molde'], $value['codigo_molde'], $value['tamanho']);
                    $tecido->setIdTecido( $value['id_tecido']);
                }
                return $tecido;

            }catch(PDOException $e){
                echo "Erro " . $e->getMessage();
            }
        }
    }
?>