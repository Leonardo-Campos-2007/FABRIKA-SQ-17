<?php
require_once '../config/conexao.php';
require_once '../model/Modelagem.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['modelagem_id'] ?? null;
    $modelagem = new Modelagem($id);

    if ($modelagem->deletar($conn)) {
        echo "✅ Modelagem deletada com sucesso!";
    } else {
        echo "⚠️ Erro ao deletar modelagem ou ID não encontrado.";
    }
}
?>
