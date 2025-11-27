<?php
  session_start();
  include_once "../../BACK/PHP/aviamentoHelper.php";

  $id = $_GET['id'] ?? null;
  $aviamento = null;
  if ($id) {
      $aviamento = Aviamento::carregar($id);
  }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Deletar Aviamento - FabrikaWeb</title>
  <link rel="stylesheet" href="../CSS/cadastro-aviamentos.css" />
</head>
<body>

  <aside class="sidebar">
   <div class="logo-s">
    <img src="../img/logo.jpeg" alt="Logo FBIK">
   </div>
  </aside>

<main class="main-content">
  <header class="page-header">
    <a href="aviamentos.php" class="voltar" style="text-decoration:none; color:#111; display:flex; align-items:center; gap:8px;">
      <h1 style="font-size:20px; font-weight:600; margin:0;">Deletar Aviamento</h1>
    </a>
  </header>

  <section class="form-container">
    <h2>Confirmação de exclusão</h2>
    <?php if ($aviamento): ?>
      <p>Tem certeza que deseja deletar o aviamento: <strong><?= htmlspecialchars($aviamento->nome) ?></strong> ?</p>
      <form method="POST" action="../../BACK/PHP/aviamentoHelper.php">
        <input type="hidden" name="tipo" value="deletar_aviamento">
        <input type="hidden" name="id_aviamento" value="<?= htmlspecialchars($aviamento->getIdAviamento()) ?>">
        <div style="text-align:center; margin-top:18px;">
          <button class="btn-primary" type="submit">Confirmar exclusão</button>
        </div>
      </form>
    <?php else: ?>
      <p>Aviamento não encontrado.</p>
    <?php endif; ?>
  </section>
</main>

<script src="../JS/main.js"></script>
</body>
</html>