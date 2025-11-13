<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/FABRIKA-SQ-17/PROJETO/BACK/PHP/banco.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/FABRIKA-SQ-17/PROJETO/BACK/PHP/fornecedor.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tipo'])) {
    $tipo = $_POST['tipo'];

    switch ($tipo) {
        case 'cad_fornecedor':
            cadastrarFornecedor();
            break;
        case 'editar_fornecedor':
            editarFornecedor();
            break;
        case 'deletar_fornecedor':
            deletarFornecedor();
            break;
    }
}

/**
 * Função para cadastrar fornecedor
 */
function cadastrarFornecedor() {
    $nome = $_POST['nome'] ?? '';
    $razao_social = $_POST['razao_social'] ?? '';
    $cnpj = $_POST['cnpj'] ?? '';

    $fornecedor = new Fornecedor($nome, $razao_social, $cnpj);
    $result = $fornecedor->inserir();

    session_start();
    if ($result) {
        $_SESSION['mensagem'] = "Fornecedor cadastrado com sucesso!";
    } else {
        $_SESSION['erro'] = "Erro ao cadastrar fornecedor!";
    }

    header('Location: ../../FRONT/HTML/cadastro_fornecedor.php');
    exit();
}

/**
 * Função para editar fornecedor
 */
function editarFornecedor() {
    $id_fornecedor = $_POST['id_fornecedor'] ?? null;
    $nome = $_POST['nome'] ?? '';
    $razao_social = $_POST['razao_social'] ?? '';
    $cnpj = $_POST['cnpj'] ?? '';

    if (empty($id_fornecedor)) {
        session_start();
        $_SESSION['erro'] = "ID do fornecedor não informado!";
        header('Location: ../../FRONT/HTML/cadastro_fornecedor.php');
        exit();
    }

    $fornecedor = new Fornecedor($nome, $razao_social, $cnpj);
    $fornecedor->setIdFornecedor($id_fornecedor);

    $result = $fornecedor->editar();

    session_start();
    if ($result) {
        $_SESSION['mensagem'] = "Fornecedor atualizado com sucesso!";
    } else {
        $_SESSION['erro'] = "Erro ao atualizar fornecedor!";
    }

    header('Location: ../../FRONT/HTML/cadastro_fornecedor.php');
    exit();
}

/**
 * Função para deletar fornecedor
 */
function deletarFornecedor() {
    $id_fornecedor = $_POST['id_fornecedor'] ?? null;

    if (empty($id_fornecedor)) {
        session_start();
        $_SESSION['erro'] = "ID do fornecedor não informado!";
        header('Location: ../../FRONT/HTML/cadastro_fornecedor.php');
        exit();
    }

    $fornecedor = new Fornecedor('', '', '');
    $fornecedor->setIdFornecedor($id_fornecedor);
    $result = $fornecedor->deletar();

    session_start();
    if ($result) {
        $_SESSION['mensagem'] = "Fornecedor deletado com sucesso!";
    } else {
        $_SESSION['erro'] = "Erro ao deletar fornecedor!";
    }

    header('Location: ../../FRONT/HTML/cadastro_fornecedor.php');
    exit();
}

/**
 * Função para listar todos os fornecedores
 */
function getFornecedores() {
    try {
        $banco = new Banco();
        $conn = $banco->conectar();
        $stmt = $conn->prepare("SELECT * FROM fornecedor");
        $stmt->execute();

        $fornecedores = array();
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $value) {
            $fornecedor = new Fornecedor($value['nome'], $value['razao_social'], $value['cnpj']);
            $fornecedor->setIdFornecedor($value['id_fornecedor']);
            array_push($fornecedores, $fornecedor);
        }

        return $fornecedores;
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
        return array();
    }
}
?>
