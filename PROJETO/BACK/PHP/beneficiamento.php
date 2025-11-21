<?php
    include_once 'BANCO/banco.php';


    class Beneficiamento{
        public $id_beneficiamento;
        public $categoria;
        public $descricao;

        function __construct($categoria, $descricao){
            $this->categoria = $categoria;
            $this->descricao =  $descricao;
        }

        function inserir(){
            $banco = new Banco();
            $conn = $banco->conectar();
            try{
                $stmt = $conn->prepare("insert into beneficiamento (categoria, descricao) values(:categoria, :descricao)");
                $stmt->bindParam(':categoria',$this->categoria);
                $stmt->bindParam(':descricao',$this->descricao);
 
                
                $result = $stmt->execute();
                $banco->fecharConexao();

                return $result;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function getIdBeneficiamento(){
            return $this->id_beneficiamento;
        }

        function setIdBeneficiamento($id_beneficiamento){
            $this->id_beneficiamento = $id_beneficiamento;
        }

        static function carregar($id_beneficiamento){
            try{
                $banco = new Banco();
                $conn = $banco->conectar();
                $stmt = $conn->prepare("select * from beneficiamento where id_beneficiamento = :id_beneficiamento");
                $stmt->bindParam(':id_beneficiamento',$id_beneficiamento);
                $stmt->execute();
                $beneficiamento = null;
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                foreach($stmt->fetchAll() as $v => $value){
                    $beneficiamento = new Beneficiamento($value['categoria'], $value['descricao']);
                    $beneficiamento->setIdBeneficiamento( $value['id_beneficiamento']);
                }
                return $beneficiamento;

            }catch(PDOException $e){
                echo "Erro " . $e->getMessage();
            }
        }
    }
?>