<?php
require_once '../config/conexao.php';
require_once '../model/Beneficiamento.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['beneficiamento_id'] ?? null;
    $beneficiamento = new Beneficiamento($id);

    if ($beneficiamento->deletar($conn)) {
        echo "✅ Beneficiamento deletado com sucesso!";
    } else {
        echo "⚠️ Erro ao deletar beneficiamento ou ID não encontrado.";
    }
}
?>
