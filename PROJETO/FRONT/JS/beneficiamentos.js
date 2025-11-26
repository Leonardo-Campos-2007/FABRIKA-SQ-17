document.addEventListener("DOMContentLoaded", function() {
  const btnAdicionar = document.querySelector(".btn-add");
  const menuButtons = document.querySelectorAll(".menu-btn");
  const searchInput = document.querySelector(".search-bar input");
  const tecidoCards = Array.from(document.querySelectorAll(".beneficiamento-card"));

  // === 1️⃣ BOTÃO ADICIONAR - REDIRECIONA PARA CADASTRO ===
  if (btnAdicionar) {
    btnAdicionar.addEventListener("click", () => {
      window.location.href = "cadastro-beneficiamentos.html";
    });
  }

  // === 2️⃣ MENU DE OPÇÕES (⋯) ===
  menuButtons.forEach(btn => {
    btn.addEventListener("click", (event) => {
      event.stopPropagation();
      fecharMenusAbertos();

      // Cria o menu flutuante
      const menu = document.createElement("div");
      menu.classList.add("opcoes-menu");
      menu.innerHTML = `
        <button class="btn-editar">✏️ Editar</button>
        <button class="btn-excluir">🗑️ Excluir</button>
      `;

      // Posiciona o menu próximo ao botão clicado
      const rect = btn.getBoundingClientRect();
      menu.style.position = "absolute";
      menu.style.top = `${rect.bottom + window.scrollY + 5}px`;
      menu.style.left = `${rect.right - 130}px`;
      menu.style.background = "#fff";
      menu.style.border = "1px solid #ddd";
      menu.style.borderRadius = "8px";
      menu.style.boxShadow = "0 4px 12px rgba(0,0,0,0.08)";
      menu.style.padding = "6px 0";
      menu.style.zIndex = "1000";
      menu.style.width = "120px";

      document.body.appendChild(menu);

      // === Ações do menu ===
      const btnEditar = menu.querySelector(".btn-editar");
      const btnExcluir = menu.querySelector(".btn-excluir");

      btnEditar.addEventListener("click", () => {
        window.location.href = "editar-beneficiamentos.html";
      });

      btnExcluir.addEventListener("click", () => {
        const card = btn.closest(".tecido-card");
        if (confirm("Tem certeza que deseja excluir este tecido?")) {
          fadeOut(card, 250);
          setTimeout(() => card.remove(), 250);
        }
        fecharMenusAbertos();
      });

      // Fecha o menu ao clicar fora
      document.addEventListener("click", fecharMenusAbertos, { once: true });
    });
  });

  // === 3️⃣ FECHAR MENUS ABERTOS ===
  function fecharMenusAbertos() {
    document.querySelectorAll(".opcoes-menu").forEach(menu => menu.remove());
  }

  // === 4️⃣ EFEITOS DE ANIMAÇÃO ===
  function fadeIn(element, duration = 250) {
    element.style.display = "block";
    element.style.opacity = 0;
    let opacity = 0;
    const step = 16 / duration;
    const interval = setInterval(() => {
      opacity += step;
      if (opacity >= 1) {
        opacity = 1;
        clearInterval(interval);
      }
      element.style.opacity = opacity;
    }, 16);
  }

  function fadeOut(element, duration = 250) {
    let opacity = 1;
    const step = 16 / duration;
    const interval = setInterval(() => {
      opacity -= step;
      if (opacity <= 0) {
        opacity = 0;
        clearInterval(interval);
        element.style.display = "none";
      }
      element.style.opacity = opacity;
    }, 16);
  }

  // === 5️⃣ BUSCA DINÂMICA COM FADE ===
  if (searchInput) {
    searchInput.addEventListener("input", () => {
      const termo = searchInput.value.toLowerCase().trim();

      tecidoCards.forEach(card => {
        const textoCard = card.innerText.toLowerCase();
        if (textoCard.includes(termo)) {
          fadeIn(card, 200);
        } else {
          fadeOut(card, 200);
        }
      });
    });
  }
});


