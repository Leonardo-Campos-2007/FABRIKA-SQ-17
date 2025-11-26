document.addEventListener("DOMContentLoaded", function() {
  const searchInput = document.querySelector(".search-bar input");
  const pedidoCards = Array.from(document.querySelectorAll(".pedido-card"));
  const paginationButtons = document.querySelectorAll(".pagination button");
  const totalPages = 5;
  let currentPage = 1;
  const itensPorPagina = 6;

  // Função auxiliar para efeito fade
  function fadeIn(element, duration = 300) {
    element.style.opacity = 0;
    element.style.display = "block";
    let opacity = 0;
    const step = 16 / duration;
    const fade = setInterval(() => {
      opacity += step;
      if (opacity >= 1) {
        opacity = 1;
        clearInterval(fade);
      }
      element.style.opacity = opacity;
    }, 16);
  }

  function fadeOut(element, duration = 300) {
    let opacity = 1;
    const step = 16 / duration;
    const fade = setInterval(() => {
      opacity -= step;
      if (opacity <= 0) {
        opacity = 0;
        element.style.display = "none";
        clearInterval(fade);
      }
      element.style.opacity = opacity;
    }, 16);
  }

  // Atualiza a visibilidade dos pedidos conforme página
  function updatePagination() {
    paginationButtons.forEach(btn => {
      if (btn.textContent === String(currentPage)) {
        btn.classList.add("active");
      } else {
        btn.classList.remove("active");
      }
    });

    pedidoCards.forEach((card, index) => {
      const start = (currentPage - 1) * itensPorPagina;
      const end = start + itensPorPagina;

      if (index >= start && index < end) {
        fadeIn(card, 250);
      } else {
        fadeOut(card, 250);
      }
    });
  }

  // Busca dinâmica
  if (searchInput) {
    searchInput.addEventListener("input", () => {
      const termo = searchInput.value.toLowerCase().trim();

      pedidoCards.forEach(card => {
        const textoCard = card.innerText.toLowerCase();
        if (textoCard.includes(termo)) {
          fadeIn(card, 200);
        } else {
          fadeOut(card, 200);
        }
      });
    });
  }

  // Controles de paginação
  paginationButtons.forEach(btn => {
    btn.addEventListener("click", () => {
      const text = btn.textContent;
      if (text === "<" && currentPage > 1) {
        currentPage--;
      } else if (text === ">" && currentPage < totalPages) {
        currentPage++;
      } else if (!isNaN(text)) {
        currentPage = Number(text);
      }
      updatePagination();
    });
  });

  // Inicializa visualização
  updatePagination();
});

// === Redirecionar para a página de detalhes ao clicar em um card ===
document.addEventListener("DOMContentLoaded", () => {
  const pedidos = document.querySelectorAll(".pedido-card");

  pedidos.forEach(card => {
    card.addEventListener("click", () => {
      // Pega o número do pedido dentro do h3
      const titulo = card.querySelector("h3")?.textContent.trim();
      const idMatch = titulo.match(/\d+/); // extrai o número (ex: 12345)
      const id = idMatch ? idMatch[0] : "0";

      // Redireciona para a página de detalhes com o ID do pedido
      window.location.href = `pedido-detalhe.html?id=${id}`;
    });
  });
});

// === PROCESSO DAS ETAPAS - CLIQUE NAS BOLINHAS / CHECK ===
document.addEventListener("DOMContentLoaded", () => {
  const etapas = document.querySelectorAll(".etapa");

  etapas.forEach(etapa => {
    const header = etapa.querySelector(".etapa-header");
    const icon = header.querySelector(".circle, .check");
    const progressFill = etapa.querySelector(".progress-fill");
    const percent = header.querySelector(".percent");

    // Adiciona o evento de clique na bolinha ou no check
    header.addEventListener("click", () => {
      const isComplete = header.classList.toggle("concluida");

      if (isComplete) {
        // Marca como concluída
        icon.classList.remove("circle");
        icon.classList.add("check");
        icon.textContent = "✔";
        progressFill.style.width = "100%";
        percent.textContent = "100%";
      } else {
        // Volta para pendente
        icon.classList.remove("check");
        icon.classList.add("circle");
        icon.textContent = "";
        progressFill.style.width = "0%";
        percent.textContent = "0%";
      }
    });
  });
});

