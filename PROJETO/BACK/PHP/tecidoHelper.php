<?php
    include_once 'BANCO/banco.php';
    include_once 'tecido.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tipo'])){
        $tipo = $_POST['tipo'];
        if($tipo === 'cad_tecido'){
            cadastrarTecido();
        }
    }


    function cadastrarTecido(){
      //  echo "oi";
        $nome = $_POST['nome'];
        $cor = $_POST['cor'];
        $peso_metros = $_POST['peso_metros'];
        $composicao = $_POST['composicao'];
        $gramatura = $_POST['gramatura'];
        $fabricante = $_POST['fabricante'];

        $tecido = new Tecido($nome, $cor, $peso_metros, $composicao, $gramatura, $fabricante);
        $result = $tecido->inserir();


        if($result){
            session_start();
            $_SESSION['mensagem'] = "Tecido cadastrado com sucesso!";
        } else {
            session_start();
            $_SESSION['erro'] = "Erro ao cadastrar tecido!";
        }

        header('Location: ../../FRONT/HTML/cadastro-tecido.php');
        exit(); // IMPORTANTE: Para o script após redirecionar

    }


    function getTecidos(){
        try{
            $banco = new Banco();
            $conn = $banco->conectar();
            $stmt = $conn->prepare("select * from tecido");
            $stmt->execute();
           
            $tecidos = array();
            foreach($stmt->fetchAll((PDO::FETCH_ASSOC)) as $value){
                $tecido = new Tecido($value['nome'], $value['cor'], $value['peso_metros'], $value['composicao'], $value['gramatura'], $value['fabricante']);
                $tecido->setIdTecido( $value['id_tecido']);
                array_push($tecidos,$tecido);
            }

            //var_dump($tecidos);
            return $tecidos;

        }catch(PDOException $e){
            echo "Erro " . $e->getMessage();
            return array();
        }
    }

?>