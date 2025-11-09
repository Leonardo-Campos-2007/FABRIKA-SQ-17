<?php
    include_once 'BANCO/banco.php';


    class Beneficiamento{
        public $id_beneficiamento;
        public $id_categoria;
        public $descricao;

        function __construct($id_categoria, $descricao){
            $this->id_categoria = $id_categoria;
            $this->descricao =  $descricao;
        }

        function inserir(){
            $banco = new Banco();
            $conn = $banco->conectar();
            try{
                $stmt = $conn->prepare("insert into beneficiamento (id_categoria, descricao) values(:id_categoria, :descricao)");
                $stmt->bindParam(':id_categoria',$this->id_categoria);
                $stmt->bindParam(':descricao',$this->descricao);
 
                
                $result = $stmt->execute();
                $banco->fecharConexao();

                return $result;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        
        public function editar(){
            if (empty($this->id_beneficiamento)) {
                return false;
            }

            $banco = new Banco();
            $conn = $banco->conectar();

            try {
              

                $stmt = $conn->prepare("UPDATE beneficiamento SET id_categoria = :id_categoria, descricao = :descricao WHERE id_beneficiamento = :id_beneficiamento");

                $stmt->bindParam(':id_categoria', $this->id_categoria);
                $stmt->bindParam(':descricao', $this->descricao);
                $stmt->bindParam(':id_beneficiamento', $this->id_beneficiamento, PDO::PARAM_INT);

                $result = $stmt->execute();

                $banco->fecharConexao();

                return $result;
            } catch (PDOException $e) {
                echo "Erro ao atualizar beneficiamento: " . $e->getMessage();
                return false;
            }
        }

       
        public function deletar(){
            if (empty($this->id_beneficiamento)) {
                return false;
            }

            $banco = new Banco();
            $conn = $banco->conectar();

            try {
                $stmt = $conn->prepare("DELETE FROM beneficiamento WHERE id_beneficiamento = :id_beneficiamento");
                $stmt->bindParam(':id_beneficiamento', $this->id_beneficiamento, PDO::PARAM_INT);

                $result = $stmt->execute();

                $banco->fecharConexao();

                return $result;
            } catch (PDOException $e) {
                echo "Erro ao deletar beneficiamento: " . $e->getMessage();
                return false;
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
                    $beneficiamento = new Beneficiamento($value['id_categoria'], $value['descricao']);
                    $beneficiamento->setIdBeneficiamento( $value['id_beneficiamento']);
                }
                return $beneficiamento;

            }catch(PDOException $e){
                echo "Erro " . $e->getMessage();
            }
        }
    }
?>
