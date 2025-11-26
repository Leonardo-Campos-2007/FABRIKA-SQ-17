<?php
header('Content-Type: application/json; charset=utf-8');

// Permitir requisições POST apenas
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode([
        'status' => 'error',
        'message' => 'Método não permitido. Use POST.'
    ]);
    exit;
}

require_once '../../Conexao.php';
require_once '../../classes/Tecido.php';

try {
    // Captura e sanitiza dados do POST
    $nome_tecido = filter_input(INPUT_POST, 'nome_tecido', FILTER_SANITIZE_STRING);
    $cor = filter_input(INPUT_POST, 'cor', FILTER_SANITIZE_STRING);
    $peso_metros = filter_input(INPUT_POST, 'peso_metros', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $composicao = filter_input(INPUT_POST, 'composicao', FILTER_SANITIZE_STRING);
    $gramatura = filter_input(INPUT_POST, 'gramatura', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $fornecedor_id = filter_input(INPUT_POST, 'fornecedor_id', FILTER_SANITIZE_NUMBER_INT);

    // Array para armazenar erros de validação
    $errors = [];

    // Validações
    if (empty($nome_tecido) || strlen($nome_tecido) > 100) {
        $errors[] = "Nome do tecido é obrigatório e deve ter no máximo 100 caracteres";
    }

    if (empty($cor) || strlen($cor) > 50) {
        $errors[] = "Cor é obrigatória e deve ter no máximo 50 caracteres";
    }

    if (empty($peso_metros) || !is_numeric($peso_metros) || $peso_metros <= 0) {
        $errors[] = "Peso por metros deve ser um número positivo";
    }

    if (empty($composicao) || strlen($composicao) > 200) {
        $errors[] = "Composição é obrigatória e deve ter no máximo 200 caracteres";
    }

    if (empty($gramatura) || !is_numeric($gramatura) || $gramatura <= 0) {
        $errors[] = "Gramatura deve ser um número positivo";
    }

    if (empty($fornecedor_id) || !is_numeric($fornecedor_id) || $fornecedor_id <= 0) {
        $errors[] = "ID do fornecedor inválido";
    }

    // Se houver erros, retorna
    if (!empty($errors)) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'Erros de validação encontrados',
            'errors' => $errors
        ]);
        exit;
    }

    // Obtém conexão
    $conn = Conexao::getConnection();

    // Verifica se fornecedor existe
    $stmt = $conn->prepare("SELECT COUNT(*) FROM fornecedor WHERE fornecedor_id = ?");
    $stmt->execute([$fornecedor_id]);
    if ($stmt->fetchColumn() == 0) {
        throw new Exception("Fornecedor não encontrado");
    }

    // Cria e insere o tecido
    $tecido = new Tecido(
        null,
        $nome_tecido,
        $cor,
        $peso_metros,
        $composicao,
        $gramatura,
        $fornecedor_id
    );

    // Captura saída do método inserir
    ob_start();
    $resultado = $tecido->inserirTecido($conn);
    $mensagem = ob_get_clean();

    // Resposta de sucesso
    echo json_encode([
        'status' => 'success',
        'message' => $mensagem,
        'data' => [
            'nome_tecido' => $nome_tecido,
            'cor' => $cor,
            'peso_metros' => $peso_metros,
            'composicao' => $composicao,
            'gramatura' => $gramatura,
            'fornecedor_id' => $fornecedor_id
        ]
    ]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Erro de banco de dados',
        'debug' => $e->getMessage() // remover em produção
    ]);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>
