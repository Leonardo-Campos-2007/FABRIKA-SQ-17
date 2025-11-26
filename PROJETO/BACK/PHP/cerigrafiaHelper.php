<?php
    include_once 'BANCO/banco.php';
    include_once 'cerigrafia.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tipo'])){
        $tipo = $_POST['tipo'];
        if($tipo === 'cad_cerigrafia'){
            cadastrarCerigrafia();
        }
    }


    function cadastrarCerigrafia(){
        $tamanho = $_POST['tamanho'];
        $cor = $_POST['cor'];

        $cerigrafia = new Cerigrafia($tamanho, $cor);
        $result = $cerigrafia->inserir();

        session_start();

        if($result){
            $_SESSION['mensagem'] = "Cerigrafía cadastrada com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao cadastrar cerigrafía!";
        }
        
        header("Location: ../../FRONT/HTML/cadastro-cerigrafias.php");
        exit();
    }


    function getCerigrafias(){
        try{
            $banco = new Banco();
            $conn = $banco->conectar();
            $stmt = $conn->prepare("select * from cerigrafia");
            $stmt->execute();
           
            $cerigrafias = array();
            foreach($stmt->fetchAll((PDO::FETCH_ASSOC)) as $value){
                $cerigrafia = new Cerigrafia($value['tamanho'], $value['cor']);
                $cerigrafia->setIdCerigrafia($value['id_cerigrafia']);
                array_push($cerigrafias,$cerigrafia);
            }

            return $cerigrafias;

        }catch(PDOException $e){
            echo "Erro " . $e->getMessage();
            return array();
        }
    }

    function editarCerigrafia($cerigrafia){
        try{
            return $cerigrafia->editar();
        }catch(PDOException $e){
            echo "Erro " . $e->getMessage();
            return false;
        }
    }

    function deletarCerigrafia($id_cerigrafia){
        try{
            $cerigrafia = Cerigrafia::carregar($id_cerigrafia);
            if($cerigrafia){
                return $cerigrafia->deletar();
            }
            return false;
        }catch(PDOException $e){
            echo "Erro " . $e->getMessage();
            return false;
        }
    }

?>
