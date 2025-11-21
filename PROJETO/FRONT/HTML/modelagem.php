<?php
  include_once "../BANCO/banco.php";
  include_once "../../BACK/PHP/modelagemHelper.php";
  $modelagens = getModelagems();
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Modelagem - FabrikaWeb</title>
  <link rel="stylesheet" href="../css/modelagem..css" />
</head>
<body>

    <!-- SIDEBAR -->
  <aside class="sidebar">
   <div class="logo-s">
    <img src="../img/logo.jpeg" alt="Logo FBIK">
   </div>

    <!-- 🔗 Biblioteca de ícones Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  
    <nav class="menu">
      <h2>Menu principal</h2>
      <a href="dashboard.html" class="menu-item">
        <i class="bi bi-grid"></i>
        Dashboard
      </a>
      <a href="pedidos.html" class="menu-item">
        <i class="bi bi-cart3"></i>
        Pedidos
      </a>

      <h2>Cadastro</h2>
      <a href="tecidos.php" class="menu-item active">
        <i class="bi bi-scissors"></i>
        Tecidos
      </a>
      <a href="aviamentos.php" class="menu-item">
        <i class="bi bi-box-seam"></i>
        Aviamentos
      </a>
      <a href="modelagem.php" class="menu-item">
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
        <div>
        <h1>Modelagens</h1>
         <p> Gerencie as modelagens dos produtos</p>
      </div>
      <button class="btn-add"><a href="cadastro-modelagens.php">+ Adicionar</a></button>
    </header>

    <section class="modelagens-container">
      <div class="search-bar">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16" style="position:absolute; top:50%; left:15px; transform:translateY(-50%); color:#555;">
          <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
        </svg>
        <input type="text" placeholder="Buscar Pedidos" style="padding-left:40px;">
      </div>

    
      <div class="cards-modelagens">

    <?php if (count($modelagens) === 0): ?>
        <p style="padding:20px; font-size:18px;">Nenhuma modelagem cadastrada.</p>

    <?php else: ?>
        <?php foreach ($modelagens as $m): ?>
            
            <div class="modelagem-card">

                <div class="card-header">
                    <h3><?= htmlspecialchars($m->tipo_molde) ?></h3>
                    <span class="codigo">MOD-<?= str_pad($m->getIdModelagem(), 3, '0', STR_PAD_LEFT) ?></span>
                    <button class="menu-btn">⋯</button>
                </div>

                <div class="card-body">
                    <p><strong>Tamanhos disponíveis</strong></p>
                    <div class="tags">
                        <?php 
                            // caso no futuro você guarde múltiplos tamanhos separados por vírgula
                            $tamanhos = explode(",", $m->tamanho);
                            foreach ($tamanhos as $t):
                        ?>
                            <span><?= htmlspecialchars(trim($t)) ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>

        <?php endforeach; ?>
    <?php endif; ?>

</div>

      </div>
    </section>
  </main>

  <script src="js/main.js"></script>
  <script src="js/modelagem.js"></script>
</body>
</html>

