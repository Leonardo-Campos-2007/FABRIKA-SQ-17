<?php
    include_once 'BANCO/banco.php';
    include_once 'beneficiamento.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tipo'])){
        $tipo = $_POST['tipo'];
        if($tipo === 'cad_beneficiamento'){
            cadastrarBeneficiamento();
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

?>