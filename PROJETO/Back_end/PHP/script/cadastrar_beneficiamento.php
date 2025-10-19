<?php
require_once 'conexao.php';
require_once 'Beneficiamento.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $digital = $_POST['digital'];
    $bordado = $_POST['bordado'];
    $sublimacao = $_POST['sublimacao'];
    $serigrafia = $_POST['serigrafia'];

    $beneficiamento = new Beneficiamento(null, $digital, $bordado, $sublimacao, $serigrafia);
    $beneficiamento->inserirBeneficiamento($conn);
}
?>
