<?php
require_once 'conexao.php';
require_once 'Tecido.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_tecido = $_POST['nome_tecido'];
    $cor = $_POST['cor'];
    $peso_metros = $_POST['peso_metros'];
    $composicao = $_POST['composicao'];
    $gramatura = $_POST['gramatura'];
    $fornecedor_id = $_POST['fornecedor_id'];

    $tecido = new Tecido(null, $nome_tecido, $cor, $peso_metros, $composicao, $gramatura, $fornecedor_id);

    $tecido->inserirTecido($conn);
}
?>
