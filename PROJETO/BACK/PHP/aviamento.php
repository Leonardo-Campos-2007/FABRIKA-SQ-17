<?php
    include_once 'BANCO/banco.php';


    class Aviamento{
        public $id_aviamento;
        public $cor;
        public $peso_quantidade;
        public $composicao;
        public $nome;
        public $tamanho;
        public $id_fornecedor;

        function __construct($nome, $cor, $peso_quantidade, $composicao, $tamanho, $id_fornecedor){
            $this->nome = $nome;
            $this->cor =  $cor;
            $this->peso_quantidade = $peso_quantidade;
            $this->composicao = $composicao;
            $this->tamanho = $tamanho;
            $this->id_fornecedor = $id_fornecedor;
        }

        function inserir(){
            $banco = new Banco();
            $conn = $banco->conectar();
            try{
                $stmt = $conn->prepare("INSERT INTO aviamento (nome, cor, peso_quantidade, composicao, tamanho, id_fornecedor) 
                                        VALUES(:nome, :cor, :peso_quantidade, :composicao, :tamanho, :id_fornecedor)");
                $stmt->bindParam(':nome',$this->nome);
                $stmt->bindParam(':cor',$this->cor);
                $stmt->bindParam(':peso_quantidade',$this->peso_quantidade);
                $stmt->bindParam(':composicao',$this->composicao);
                $stmt->bindParam(':tamanho',$this->tamanho);
                $stmt->bindParam(':id_fornecedor',$this->id_fornecedor);
                
                $result = $stmt->execute();
                $banco->fecharConexao();

                return $result;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

      
        public function editar(){
            if (empty($this->id_aviamento)) {
                return false;
            }

            $banco = new Banco();
            $conn = $banco->conectar();

            try {
               

                $stmt = $conn->prepare("UPDATE aviamento SET nome = :nome, cor = :cor, peso_quantidade = :peso_quantidade, composicao = :composicao, tamanho = :tamanho, id_fornecedor = :id_fornecedor WHERE id_aviamento = :id_aviamento");

                $stmt->bindParam(':nome', $this->nome);
                $stmt->bindParam(':cor', $this->cor);
                $stmt->bindParam(':peso_quantidade', $this->peso_quantidade);
                $stmt->bindParam(':composicao', $this->composicao);
                $stmt->bindParam(':tamanho', $this->tamanho);
                $stmt->bindParam(':id_fornecedor', $this->id_fornecedor, PDO::PARAM_INT);
                $stmt->bindParam(':id_aviamento', $this->id_aviamento, PDO::PARAM_INT);

                $result = $stmt->execute();

                $banco->fecharConexao();

                return $result;
            } catch (PDOException $e) {
                echo "Erro ao atualizar aviamento: " . $e->getMessage();
                return false;
            }
        }

        public function deletar(){
            if (empty($this->id_aviamento)) {
                return false;
            }

            $banco = new Banco();
            $conn = $banco->conectar();

            try {
                $stmt = $conn->prepare("DELETE FROM aviamento WHERE id_aviamento = :id_aviamento");
                $stmt->bindParam(':id_aviamento', $this->id_aviamento, PDO::PARAM_INT);

                $result = $stmt->execute();

                $banco->fecharConexao();

                return $result;
            } catch (PDOException $e) {
                echo "Erro ao deletar aviamento: " . $e->getMessage();
                return false;
            }
        }

        function getIdAviamento(){
            return $this->id_aviamento;
        }

        function setIdAviamento($id_aviamento){
            $this->id_aviamento = $id_aviamento;
        }

        static function carregar($id_aviamento){
            try{
                $banco = new Banco();
                $conn = $banco->conectar();
                $stmt = $conn->prepare("select * from aviamento where id_aviamento = :id_aviamento");
                $stmt->bindParam(':id_aviamento',$id_aviamento);
                $stmt->execute();
                $aviamento = null;
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                foreach($stmt->fetchAll() as $v => $value){
                    $aviamento = new Aviamento($value['nome'], $value['cor'], $value['peso_quantidade'], $value['composicao'], $value['tamanho'],
                    $value['id_fornecedor']);
                    $aviamento->setIdAviamento( $value['id_aviamento']);
                }
                return $aviamento;

            }catch(PDOException $e){
                echo "Erro " . $e->getMessage();
            }
        }
    }
?>