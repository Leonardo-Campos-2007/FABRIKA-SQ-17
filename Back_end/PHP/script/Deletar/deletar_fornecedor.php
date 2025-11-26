<?php
require_once '../config/conexao.php';
require_once '../model/Fornecedor.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['fornecedor_id'] ?? null;
    $fornecedor = new Fornecedor($id);

    if ($fornecedor->deletar($conn)) {
        echo "✅ Fornecedor deletado com sucesso!";
    } else {
        echo "⚠️ Erro ao deletar fornecedor ou ID não encontrado.";
    }
}
?>
