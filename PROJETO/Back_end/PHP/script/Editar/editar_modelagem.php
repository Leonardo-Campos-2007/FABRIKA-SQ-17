<?php
require_once '../config/conexao.php';
require_once '../model/Modelagem.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['modelagem_id'] ?? null;
    $tipo = $_POST['tipo_molde'] ?? null;
    $codigo = $_POST['codigo_molde'] ?? null;

    $modelagem = new Modelagem($id, $tipo, $codigo);

    if ($modelagem->editar($conn)) {
        echo "✅ Modelagem atualizada com sucesso!";
    } else {
        echo "⚠️ Nenhuma alteração detectada ou erro na atualização.";
    }
}
?>
