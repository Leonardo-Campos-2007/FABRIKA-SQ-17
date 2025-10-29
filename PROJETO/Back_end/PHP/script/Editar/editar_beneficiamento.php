<?php
require_once '../config/conexao.php';
require_once '../model/Beneficiamento.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $beneficiamento = new Beneficiamento(
        $_POST['beneficiamento_id'] ?? null,
        $_POST['digital'] ?? null,
        $_POST['bordado'] ?? null,
        $_POST['sublimacao'] ?? null,
        $_POST['serigrafia'] ?? null
    );

    if ($beneficiamento->editar($conn)) {
        echo "✅ Beneficiamento atualizado com sucesso!";
    } else {
        echo "⚠️ Nenhuma alteração detectada ou erro na atualização.";
    }
}
?>
