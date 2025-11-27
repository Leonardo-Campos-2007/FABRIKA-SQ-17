<?php
  session_start();
  include_once "../../BACK/PHP/beneficiamentoHelper.php";

  $id = $_GET['id'] ?? null;
  $beneficiamento = null;
  if ($id) {
      $beneficiamento = Beneficiamento::carregar($id);
  }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Deletar Beneficiamento - FabrikaWeb</title>
  <link rel="stylesheet" href="../CSS/cadastro-beneficiamentos.css" />
</head>
<body>

  <aside class="sidebar">
   <div class="logo-s">
    <img src="../img/logo.jpeg" alt="Logo FBIK">
   </div>
  </aside>

<main class="main-content">
  <header class="page-header">
    <a href="beneficiamentos.php" class="voltar" style="text-decoration:none; color:#111; display:flex; align-items:center; gap:8px;">
      <h1 style="font-size:20px; font-weight:600; margin:0;">Deletar Beneficiamento</h1>
    </a>
  </header>

  <section class="form-container">
    <h2>Confirmação de exclusão</h2>
    <?php if ($beneficiamento): ?>
      <p>Tem certeza que deseja deletar o beneficiamento: <strong><?= htmlspecialchars($beneficiamento->descricao) ?></strong> ?</p>
      <form method="POST" action="../../BACK/PHP/beneficiamentoHelper.php">
        <input type="hidden" name="tipo" value="deletar_beneficiamento">
        <input type="hidden" name="id_beneficiamento" value="<?= htmlspecialchars($beneficiamento->getIdBeneficiamento()) ?>">
        <div style="text-align:center; margin-top:18px;">
          <button class="btn-primary" type="submit">Confirmar exclusão</button>
        </div>
      </form>
    <?php else: ?>
      <p>Beneficiamento não encontrado.</p>
    <?php endif; ?>
  </section>
</main>

<script src="../JS/main.js"></script>
</body>
</html>