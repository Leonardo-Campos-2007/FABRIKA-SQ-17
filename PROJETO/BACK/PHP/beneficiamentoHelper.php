<?php
    include_once 'BANCO/banco.php';
    include_once 'beneficiamento.php';



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

        function deletarBeneficiamento($id_beneficiamento){
            try{
                $banco = new Banco();
                $conn = $banco->conectar();
                $stmt = $conn->prepare("delete from beneficiamento where id_beneficiamento = :id_beneficiamento");
                $stmt->bindParam(':id_beneficiamento', $id_beneficiamento);
                return $stmt->execute();
            }catch(PDOException $e){
                echo "Erro " . $e->getMessage();
                return false;
            }
        }

        function editarBeneficiamento($beneficiamento){
            try{
                $banco = new Banco();
                $conn = $banco->conectar();
                $stmt = $conn->prepare("update beneficiamento set id_categoria = :id_categoria, descricao = :descricao where id_beneficiamento = :id_beneficiamento");
                $stmt->bindParam(':id_categoria', $beneficiamento->getIdCategoria());
                $stmt->bindParam(':descricao', $beneficiamento->getDescricao());
                $stmt->bindParam(':id_beneficiamento', $beneficiamento->getIdBeneficiamento());
                return $stmt->execute();
            }catch(PDOException $e){
                echo "Erro " . $e->getMessage();
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


    function cadastrarBeneficiamento(){
      //  echo "oi";
        $categoria = $_POST['categoria'];
        $descricao = $_POST['descricao'];

        $beneficiamento = new Beneficiamento($categoria, $descricao);
        $result = $beneficiamento->inserir();

        session_start();

        if($result){
            $_SESSION['mensagem'] = "Beneficiamento cadastrado com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao cadastrar beneficiamento!";
        }
        
        header("Location: ../../FRONT/HTML/cadastro-beneficiamentos.php");
        exit(); // IMPORTANTE: Para o script após redirecionar

    }


    function getBeneficiamentos(){
        try{
            $banco = new Banco();
            $conn = $banco->conectar();
            $stmt = $conn->prepare("select * from beneficiamento");
            $stmt->execute();
           
            $beneficiamentos = array();
            foreach($stmt->fetchAll((PDO::FETCH_ASSOC)) as $value){
                $beneficiamento = new Beneficiamento($value['categoria'], $value['descricao']);
                $beneficiamento->setIdBeneficiamento($value['id_beneficiamento']);
                array_push($beneficiamentos,$beneficiamento);
            }

            //var_dump($beneficiamentos);
            return $beneficiamentos;

        }catch(PDOException $e){
            echo "Erro " . $e->getMessage();
            return array();
        }
    }

    function editarBeneficiamento($beneficiamento){
        try{
            return $beneficiamento->editar();
        }catch(PDOException $e){
            echo "Erro " . $e->getMessage();
            return false;
        }
    }

    function deletarBeneficiamento($id_beneficiamento){
        try{
            $beneficiamento = Beneficiamento::carregar($id_beneficiamento);
            if($beneficiamento){
                return $beneficiamento->deletar();
            }
            return false;
        }catch(PDOException $e){
            echo "Erro " . $e->getMessage();
            return false;
        }
    }

?>