<?php
    include_once 'BANCO/banco.php';
    include_once 'modelagem.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tipo'])){
        $tipo = $_POST['tipo'];
        if($tipo === 'cad_modelagem'){
            cadastrarModelagem();
        }
    }


    function cadastrarModelagem(){
      //  echo "oi";
        $tipo_molde = $_POST['tipo_molde'];
        $codigo_molde = $_POST['codigo_molde'];
        $tamanho = $_POST['tamanho'];


        $modelagem = new Modelagem($tipo_molde, $codigo_molde, $tamanho);
        $result = $modelagem->inserir();


        if($result){
            session_start();
            $_SESSION['mensagem'] = "Modelagem cadastrado com sucesso!";
        } else {
            session_start();
            $_SESSION['erro'] = "Erro ao cadastrar modelagem!";
        }

        header('Location: ../../FRONT/HTML/cadastro_modelagem.php');
        exit(); // IMPORTANTE: Para o script após redirecionar

    }


    function getModelagems(){
        try{
            $banco = new Banco();
            $conn = $banco->conectar();
            $stmt = $conn->prepare("select * from modelagem");
            $stmt->execute();
           
            $modelagems = array();
            foreach($stmt->fetchAll((PDO::FETCH_ASSOC)) as $value){
                $modelagem = new Modelagem($value['tipo_molde'], $value['codigo_molde'], $value['tamanho']);
                $modelagem->setIdModelagem( $value['id_modelagem']);
                array_push($modelagems,$modelagem);
            }

            //var_dump($modelagems);
            return $modelagems;

        }catch(PDOException $e){
            echo "Erro " . $e->getMessage();
            return array();
        }
    }

?>