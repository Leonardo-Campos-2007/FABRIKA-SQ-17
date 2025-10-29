<?php
require_once 'conexao.php';
require_once 'Aviamento.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo_aviamento = $_POST['tipo_aviamento'];
    $cor = $_POST['cor'];
    $peso_quantidade = $_POST['peso_quantidade'];
    $composicao = $_POST['composicao'];

    $aviamento = new Aviamento(null, $tipo_aviamento, $cor, $peso_quantidade, $composicao);
    $aviamento->inserirAviamento($conn);
}
?>
