<?php
    include_once 'BANCO/banco.php';
    include_once 'aviamento.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tipo'])){
        $tipo = $_POST['tipo'];
        if($tipo === 'cad_aviamento'){
            cadastrarAviamento();
        }
    }


    function cadastrarAviamento(){
      //  echo "oi";
        $nome = $_POST['nome'];
        $cor = $_POST['cor'];
        $peso_quantidade = $_POST['peso_quantidade'];
        $composicao = $_POST['composicao'];
        $tamanho = $_POST['tamanho'];
        $id_fornecedor = $_POST['id_fornecedor'];

        $aviamento = new Aviamento($nome, $cor, $peso_quantidade, $composicao, $tamanho, $id_fornecedor);
        $result = $aviamento->inserir();


        if($result){
            session_start();
            $_SESSION['mensagem'] = "Aviamento cadastrado com sucesso!";
        } else {
            session_start();
            $_SESSION['erro'] = "Erro ao cadastrar aviamento!";
        }

        header('Location: ../../FRONT/HTML/cadastro_aviamento.php');
        exit(); // IMPORTANTE: Para o script após redirecionar

    }


    function getAviamentos(){
        try{
            $banco = new Banco();
            $conn = $banco->conectar();
            $stmt = $conn->prepare("select * from aviamento");
            $stmt->execute();
           
            $aviamentos = array();
            foreach($stmt->fetchAll((PDO::FETCH_ASSOC)) as $value){
                $aviamento = new Aviamento($value['nome'], $value['cor'], $value['peso_quantidade'], $value['tamanho'], $value['id_fornecedor']);
                $aviamento->setIdAviamento( $value['id_aviamento']);
                array_push($aviamentos,$aviamento);
            }

            //var_dump($aviamentos);
            return $aviamentos;

        }catch(PDOException $e){
            echo "Erro " . $e->getMessage();
            return array();
        }
    }

?>