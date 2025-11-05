<?php
    // include_once "../../BACK/PHP/aviamentoHelper.php"; // REMOVA ESTA LINHA - não é necessária aqui
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teste Aviamento</title>
</head>
<body>
    <h2>Teste Cadastro Aviamento</h2>
    
    <!-- ✅ CORREÇÃO: Action apontando para o caminho correto -->
    <form action="../../BACK/PHP/aviamentoHelper.php" method="POST">
        <input type="hidden" name="tipo" value="cad_aviamento">
        
        Nome: <input type="text" name="nome" value="Zíper Teste" required><br>
        Cor: <input type="text" name="cor" value="Preto"><br>
        Peso/Quantidade: <input type="text" name="peso_quantidade" value="100g"><br>
        Composição: <input type="text" name="composicao" value="Nylon"><br>
        Tamanho: <input type="text" name="tamanho" value="50cm"><br>
        ID Fornecedor: <input type="number" name="id_fornecedor" value="1" required><br>
        
        <input type="submit" value="Testar Cadastro">
    </form>

    <p><strong>Nota:</strong> Após enviar, você será redirecionado para a página de cadastro.</p>

    <!-- ✅ DEBUG: Link para testar se o arquivo PHP existe -->
    <p>
        <a href="../../BACK/PHP/aviamentoHelper.php" target="_blank">
            Testar se aviamentoHelper.php está acessível
        </a>
    </p>
</body>
</html>