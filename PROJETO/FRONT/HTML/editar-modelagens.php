<?php
  session_start();
  include_once "../../BACK/PHP/modelagemHelper.php";

  $id = $_GET['id'] ?? null;
  $modelagem = null;
  if ($id) {
      $modelagem = Modelagem::carregar($id);
  }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Editar Modelagens - FabrikaWeb</title>
  <link rel="stylesheet" href="../CSS/cadastro-modelagens.css" />
</head>
<body>

    <!-- SIDEBAR -->
  <aside class="sidebar">
   <div class="logo-s">
    <img src="../img/logo.jpeg" alt="Logo FBIK">
   </div>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <nav class="menu">
    <h2>Menu principal</h2>
    <a href="dashboard.html" class="menu-item">
      <i class="bi bi-grid"></i>
      Dashboard
    </a>

    <h2>Cadastro</h2>
    <a href="tecidos.php" class="menu-item">
      <i class="bi bi-scissors"></i>
      Tecidos
    </a>
    <a href="aviamentos.php" class="menu-item">
      <i class="bi bi-box-seam"></i>
      Aviamentos
    </a>
    <a href="modelagem.php" class="menu-item active">
      <i class="bi bi-grid-3x3-gap"></i>
      Modelagem
    </a>
    <a href="beneficiamentos.php" class="menu-item">
      <i class="bi bi-brush"></i>
      Beneficiamentos
    </a>

    <a href="configuracoes.html" class="menu-item">
      <i class="bi bi-gear"></i>
      Configurações
    </a>

    <button class="btn-sair">Sair</button>
  </nav>
</aside>

<main class="main-content">
  <header class="page-header">
    <a href="modelagem.php" class="voltar" style="text-decoration:none; color:#111; display:flex; align-items:center; gap:8px;">
      <h1 style="font-size:20px; font-weight:600; margin:0;">Editar Modelagens</h1>
    </a>
  </header>

  <section class="form-container">
    <h2>Informações da Modelagem</h2>
    <form name="formEdit" method="POST" action="../../BACK/PHP/modelagemHelper.php">
      <input type="hidden" name="tipo" value="editar_modelagem">
      <input type="hidden" name="id_modelagem" value="<?= htmlspecialchars($modelagem ? $modelagem->getIdModelagem() : '') ?>">

      <label>Tipo de Molde:</label>
      <input type="text" name="tipo_molde" value="<?= htmlspecialchars($modelagem ? $modelagem->tipo_molde : '') ?>">

      <label>Código:</label>
      <input type="text" name="codigo_molde" value="<?= htmlspecialchars($modelagem ? $modelagem->codigo_molde : '') ?>">

      <label>Tamanhos:</label>
      <input type="text" name="tamanho" value="<?= htmlspecialchars($modelagem ? $modelagem->tamanho : '') ?>">

      <div style="text-align:center; margin-top:18px;">
        <button class="btn-primary" type="submit">Salvar</button>
      </div>
    </form>
  </section>
</main>

<script src="../JS/main.js"></script>
</body>
</html>