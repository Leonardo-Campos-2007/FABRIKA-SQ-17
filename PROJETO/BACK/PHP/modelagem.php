<?php
    include_once 'BANCO/banco.php';


    class modelagem{
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

       
        public function editar(){
            if (empty($this->id_modelagem)) {
                return false;
            }

            $banco = new Banco();
            $conn = $banco->conectar();

            try {
               

                $stmt = $conn->prepare("UPDATE tecido SET tipo_molde = :tipo_molde, codigo_molde = :codigo_molde, tamanho = :tamanho WHERE id_tecido = :id_tecido");

                $stmt->bindParam(':tipo_molde', $this->tipo_molde);
                $stmt->bindParam(':codigo_molde', $this->codigo_molde);
                $stmt->bindParam(':tamanho', $this->tamanho);
                $stmt->bindParam(':id_modelagem', $this->id_modelagem, PDO::PARAM_INT);

                $result = $stmt->execute();

                $banco->fecharConexao();

                return $result;
            } catch (PDOException $e) {
                echo "Erro ao atualizar tecido: " . $e->getMessage();
                return false;
            }
        }

       
        public function deletar()
        {
            if (empty($this->id_modelagem)) {
                return false;
            }

            $banco = new Banco();
            $conn = $banco->conectar();

            try {
                $stmt = $conn->prepare("DELETE FROM tecido WHERE id_tecido = :id_tecido");
                $stmt->bindParam(':id_tecido', $this->id_modelagem, PDO::PARAM_INT);

                $result = $stmt->execute();

                $banco->fecharConexao();

                return $result;
            } catch (PDOException $e) {
                echo "Erro ao deletar tecido: " . $e->getMessage();
                return false;
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
                $stmt = $conn->prepare("select * from tecido where id_tecido = :id_tecido");
                $stmt->bindParam(':id_tecido',$id_modelagem);
                $stmt->execute();
                $tecido = null;
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                foreach($stmt->fetchAll() as $v => $value){
                    $modelagem = new modelagem($value['tipo_molde'], $value['codigo_molde'], $value['tamanho']);
                    $modelagem->setIdModelagem($value['id_modelagem']);
                }
                return $modelagem;

            }catch(PDOException $e){
                echo "Erro " . $e->getMessage();
            }
        }
    }
?>
