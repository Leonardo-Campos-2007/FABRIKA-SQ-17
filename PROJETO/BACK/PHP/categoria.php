<?php
    include_once 'BANCO/banco.php';


    class Categoria{
        public $id_categoria;
        public $nome;

        function __construct($nome){
            $this->nome =  $nome;
        }

        function inserir(){
            $banco = new Banco();
            $conn = $banco->conectar();
            try{
                $stmt = $conn->prepare("insert into categoria (nome) values(:nome)");
                $stmt->bindParam(':nome',$this->nome);
 
                
                $result = $stmt->execute();
                $banco->fecharConexao();

                return $result;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        function getIdCategoria(){
            return $this->id_categoria;
        }

        function setIdCategoria($id_categoria){
            $this->id_categoria = $id_categoria;
        }

        static function carregar($id_categoria){
            try{
                $banco = new Banco();
                $conn = $banco->conectar();
                $stmt = $conn->prepare("select * from categoria where id_categoria = :id_categoria");
                $stmt->bindParam(':id_categoria',$id_categoria);
                $stmt->execute();
                $categoria = null;
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                foreach($stmt->fetchAll() as $v => $value){
                    $categoria = new Categoria($value['nome']);
                    $categoria->setIdCategoria( $value['id_categoria']);
                }
                return $categoria;

            }catch(PDOException $e){
                echo "Erro " . $e->getMessage();
            }
        }
    }
?>