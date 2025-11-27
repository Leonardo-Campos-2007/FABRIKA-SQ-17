<?php
    include_once 'BANCO/banco.php';
    include_once 'tecido.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tipo'])){
        $tipo = $_POST['tipo'];
        switch($tipo){
            case 'cad_tecido':
                cadastrarTecido();
                break;
            case 'editar_tecido':
                editarTecido();
                break;
            case 'deletar_tecido':
                deletarTecido();
                break;
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
  
                $tecido = new Tecido($value['nome'], $value['cor'], $value['peso_metro'], $value['composicao'], $value['tamanho'], $value['id_fornecedor']);

                $tecido->setIdTecido( $value['id_tecido']);
                // sincroniza aliases usados pelo front
                $tecido->nome = $tecido->nome_tecido;
                $tecido->peso_metros = $tecido->peso_metro;
                $tecido->gramatura = $tecido->tamanho;
                $tecido->fabricante = $tecido->id_fornecedor;
                array_push($tecidos,$tecido);
            }

            //var_dump($tecidos);
            return $tecidos;

        }catch(PDOException $e){
            echo "Erro " . $e->getMessage();
            return array();
        }
    }


    function editarTecido(){
        $id_tecido = $_POST['id_tecido'] ?? null;
        $nome = $_POST['nome'] ?? '';
        $cor = $_POST['cor'] ?? '';
        $peso_metros = $_POST['peso_metros'] ?? '';
        $composicao = $_POST['composicao'] ?? '';
        $gramatura = $_POST['gramatura'] ?? '';
        $fabricante = $_POST['fabricante'] ?? '';

        if (empty($id_tecido)) {
            session_start();
            $_SESSION['erro'] = "ID do tecido não informado!";
            header('Location: ../../FRONT/HTML/tecidos.php');
            exit();
        }

        $tecido = Tecido::carregar($id_tecido);
        if (!$tecido) {
            session_start();
            $_SESSION['erro'] = "Tecido não encontrado!";
            header('Location: ../../FRONT/HTML/tecidos.php');
            exit();
        }

        // Atualiza propriedades internas usadas pelo model
        $tecido->nome_tecido = $nome;
        $tecido->cor = $cor;
        $tecido->peso_metro = $peso_metros;
        $tecido->composicao = $composicao;
        $tecido->tamanho = $gramatura;
        $tecido->id_fornecedor = $fabricante;

        $result = $tecido->editar();

        session_start();
        if ($result) {
            $_SESSION['mensagem'] = "Tecido atualizado com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao atualizar tecido!";
        }

        header('Location: ../../FRONT/HTML/tecidos.php');
        exit();
    }

    function deletarTecido(){
        $id_tecido = $_POST['id_tecido'] ?? null;

        if (empty($id_tecido)) {
            session_start();
            $_SESSION['erro'] = "ID do tecido não informado!";
            header('Location: ../../FRONT/HTML/tecidos.php');
            exit();
        }

        $tecido = new Tecido("", "", "", "", "", "");
        $tecido->setIdTecido($id_tecido);
        $result = $tecido->deletar();

        session_start();
        if ($result) {
            $_SESSION['mensagem'] = "Tecido deletado com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao deletar tecido!";
        }

        header('Location: ../../FRONT/HTML/tecidos.php');
        exit();
    }

?>