<?php
require_once '../config/conexao.php';
require_once '../model/Fornecedor.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['fornecedor_id'] ?? null;
    $nome = $_POST['nome_fornecedor'] ?? null;
    $razao = $_POST['razao_social'] ?? null;
    $cnpj = $_POST['cnpj'] ?? null;

    $fornecedor = new Fornecedor($id, $nome, $razao, $cnpj);

    if ($fornecedor->editar($conn)) {
        echo "✅ Fornecedor atualizado com sucesso!";
    } else {
        echo "⚠️ Nenhuma alteração detectada ou erro na atualização.";
    }
}
?>
