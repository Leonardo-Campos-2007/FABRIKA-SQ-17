<?php
header('Content-Type: application/json');
require_once '../Conexao.php';
require_once '../classes/Tecido.php';

try {
    $conn = Conexao::getConnection();

    // Captura dados do POST
    $tecido_id = $_POST['tecido_id'] ?? '';
    $nome_tecido = $_POST['nome_tecido'] ?? '';
    $cor = $_POST['cor'] ?? '';
    $peso_metros = $_POST['peso_metros'] ?? '';
    $composicao = $_POST['composicao'] ?? '';
    $gramatura = $_POST['gramatura'] ?? '';
    $fornecedor_id = $_POST['fornecedor_id'] ?? '';

    // Validação básica
    if (empty($tecido_id)) {
        throw new Exception("ID do tecido é obrigatório");
    }

    if (empty($nome_tecido) || empty($cor) || empty($peso_metros) || empty($composicao) || empty($gramatura) || empty($fornecedor_id)) {
        throw new Exception("Todos os campos são obrigatórios");
    }

    // Cria objeto Tecido e edita
    $tecido = new Tecido($tecido_id, $nome_tecido, $cor, $peso_metros, $composicao, $gramatura, $fornecedor_id);
    
    ob_start(); // Inicia buffer de saída para capturar mensagens de echo
    $resultado = $tecido->editarTecido($conn);
    $mensagem = ob_get_clean(); // Captura mensagens e limpa buffer

    if ($resultado) {
        echo json_encode([
            'status' => 'success',
            'message' => $mensagem
        ]);
    } else {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => $mensagem
        ]);
    }

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>