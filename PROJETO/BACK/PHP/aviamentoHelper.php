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

        session_start();

        if($result){
            $_SESSION['mensagem'] = "Aviamento cadastrado com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao cadastrar aviamento!";
        }
        
        header("Location: /FABRIKA-SQ-17/PROJETO/FRONT/HTML/cadastro-aviamentos.php");
        exit(); // IMPORTANTE: Para o script após redirecionar

    }

    function deletarAviamento($id_aviamento){
        try{
            $banco = new Banco();
            $conn = $banco->conectar();
            $stmt = $conn->prepare("delete from aviamento where id_aviamento = :id_aviamento");
            $stmt->bindParam(':id_aviamento', $id_aviamento);
            return $stmt->execute();
        }catch(PDOException $e){
            echo "Erro " . $e->getMessage();
            return false;
        }
    }

    function editarAviamento($aviamento){
        try{
            $banco = new Banco();
            $conn = $banco->conectar();
            $stmt = $conn->prepare("update aviamento set nome = :nome, cor = :cor, peso_quantidade = :peso_quantidade, tamanho = :tamanho, id_fornecedor = :id_fornecedor where id_aviamento = :id_aviamento");
            $stmt->bindParam(':nome', $aviamento->nome);
            $stmt->bindParam(':cor', $aviamento->cor);
            $stmt->bindParam(':peso_quantidade', $aviamento->peso_quantidade);
            $stmt->bindParam(':tamanho', $aviamento->tamanho);
            $stmt->bindParam(':id_fornecedor', $aviamento->id_fornecedor);
            $stmt->bindParam(':id_aviamento', $aviamento->id_aviamento);
            return $stmt->execute();
        }catch(PDOException $e){
            echo "Erro " . $e->getMessage();
            return false;
        }
    }

    function deletarAviamentoPorId($id_aviamento){
        try{
            $aviamento = Aviamento::carregar($id_aviamento);
            if($aviamento){
                return $aviamento->deletar();
            }
            return false;
        }catch(PDOException $e){
            echo "Erro " . $e->getMessage();
            return false;
        }
    }

    function getAviamentos(){
        try{
            $banco = new Banco();
            $conn = $banco->conectar();
            $stmt = $conn->prepare("select * from aviamento");
            $stmt->execute();
           
            $aviamentos = array();
            foreach($stmt->fetchAll((PDO::FETCH_ASSOC)) as $value){
                $aviamento = new Aviamento($value['nome'], $value['cor'], $value['peso_quantidade'], $value['composicao'], $value['tamanho'], $value['id_fornecedor']);
                $aviamento->setIdAviamento($value['id_aviamento']);
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