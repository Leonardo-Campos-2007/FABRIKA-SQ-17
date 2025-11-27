<?php
  session_start();
  include_once "../../BACK/PHP/tecidoHelper.php";

  $id = $_GET['id'] ?? null;
  $tecido = null;
  if ($id) {
      $tecido = Tecido::carregar($id);
  }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Deletar Tecido - FabrikaWeb</title>
  <link rel="stylesheet" href="../CSS/cadastro-tecido.css" />
</head>
<body>

  <aside class="sidebar">
   <div class="logo-s">
    <img src="../img/logo.jpeg" alt="Logo FBIK">
   </div>
  </aside>

<main class="main-content">
  <header class="page-header">
    <a href="tecidos.php" class="voltar" style="text-decoration:none; color:#111; display:flex; align-items:center; gap:8px;">
      <h1 style="font-size:20px; font-weight:600; margin:0;">Deletar Tecido</h1>
    </a>
  </header>

  <section class="form-container">
    <h2>Confirmação de exclusão</h2>
    <?php if ($tecido): ?>
      <p>Tem certeza que deseja deletar o tecido: <strong><?= htmlspecialchars($tecido->nome) ?></strong> ?</p>
      <form method="POST" action="../../BACK/PHP/tecidoHelper.php">
        <input type="hidden" name="tipo" value="deletar_tecido">
        <input type="hidden" name="id_tecido" value="<?= htmlspecialchars($tecido->getIdTecido()) ?>">
        <div style="text-align:center; margin-top:18px;">
          <button class="btn-primary" type="submit">Confirmar exclusão</button>
        </div>
      </form>
    <?php else: ?>
      <p>Tecido não encontrado.</p>
    <?php endif; ?>
  </section>
</main>

<script src="../JS/main.js"></script>
</body>
</html>