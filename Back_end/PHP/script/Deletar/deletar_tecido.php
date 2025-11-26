<?php
header('Content-Type: application/json');
require_once '../Conexao.php';
require_once '../classes/Tecido.php';

try {
    $conn = Conexao::getConnection();

    // Captura ID do POST ou GET
    $tecido_id = $_REQUEST['tecido_id'] ?? '';

    // Validação básica
    if (empty($tecido_id)) {
        throw new Exception("ID do tecido é obrigatório");
    }

    // Cria objeto Tecido e deleta
    $tecido = new Tecido($tecido_id, null, null, null, null, null, null);
    
    ob_start(); // Inicia buffer de saída para capturar mensagens de echo
    $resultado = $tecido->deletarTecido($conn);
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