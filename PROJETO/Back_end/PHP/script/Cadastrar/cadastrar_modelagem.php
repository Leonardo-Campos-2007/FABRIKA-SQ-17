<?php
require_once 'conexao.php';
require_once 'Modelagem.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo_molde = $_POST['tipo_molde'];
    $codigo_molde = $_POST['codigo_molde'];

    // Cria o objeto e insere no banco
    $modelagem = new Modelagem(null, $tipo_molde, $codigo_molde);
    $modelagem->inserirModelagem($conn);
}
?>
