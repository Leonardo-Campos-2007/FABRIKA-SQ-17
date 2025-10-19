<?php
require_once 'conexao.php';
require_once 'Fornecedor.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_fornecedor = $_POST['nome_fornecedor'];
    $razao_social = $_POST['razao_social'];
    $cnpj = $_POST['cnpj'];

    $fornecedor = new Fornecedor(null, $nome_fornecedor, $razao_social, $cnpj);
    $fornecedor->inserirFornecedor($conn);
}
?>
