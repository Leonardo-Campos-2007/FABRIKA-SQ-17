document.addEventListener('DOMContentLoaded', () => {
  // marca menu ativo baseado no href atual
  const links = document.querySelectorAll('.menu a');
  links.forEach(a => {
    const href = a.getAttribute('href');
    if (href && location.pathname.includes(href)) {
      a.classList.add('active');
    }
  });
});

// util: remover linha de tabela
function deleteRow(btn) {
  if (!confirm('Tem certeza que deseja excluir este item?')) return;
  const tr = btn.closest('tr');
  tr.parentNode.removeChild(tr);
  showToast('Item excluído com sucesso');
}

// toast simples
function showToast(msg) {
  const t = document.createElement('div');
  t.className = 'toast';
  t.textContent = msg;
  Object.assign(t.style, {
    position: 'fixed',
    top: '20px',
    left: '50%',
    transform: 'translateX(-50%)',
    background: '#111',
    color: '#fff',
    padding: '10px 18px',
    borderRadius: '8px',
    zIndex: 9999,
    opacity: 0,
    transition: 'all .25s'
  });
  document.body.appendChild(t);
  requestAnimationFrame(()=> t.style.opacity = 1);
  setTimeout(()=> {
    t.style.opacity = 0;
    setTimeout(()=> t.remove(), 300);
  }, 2000);
}

// === GRÁFICO (executa só se o elemento existir) ===
const ctx = document.getElementById('graficoProducao');
if (ctx) {
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [
        'Produto A', 'Produto B', 'Produto C', 'Produto D',
        'Produto A', 'Produto B', 'Produto C', 'Produto D',
        'Produto A', 'Produto B', 'Produto C', 'Produto D'
      ],
      datasets: [{
        label: 'Valor',
        data: [100, 75, 95, 25, 100, 75, 95, 25, 100, 75, 95, 25],
        backgroundColor: 'rgba(153, 102, 255, 0.8)',
        borderRadius: 6,
        borderSkipped: false
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: {
          beginAtZero: true,
          ticks: { stepSize: 25 },
          grid: { color: '#eee' }
        },
        x: {
          grid: { display: false },
          ticks: { maxRotation: 0, autoSkip: false }
        }
      },
      plugins: {
        legend: { display: false },
        title: { display: false }
      },
      categoryPercentage: 0.85,
      barPercentage: 0.85
    }
  });
}

// === BOTÃO SAIR ===
document.addEventListener("DOMContentLoaded", () => {
  const btnSair = document.querySelector(".btn-sair");
  
  if (btnSair) {
    btnSair.addEventListener("click", () => {
      const confirmar = confirm("Deseja realmente sair?");
      if (confirmar) {
        document.body.style.transition = "opacity 0.4s ease";
        document.body.style.opacity = "0";
        setTimeout(() => {
          window.location.href = "login.html"; // mesmo nível dos HTMLs
        }, 400);
      }
    });
  } else {
    console.warn("⚠️ Botão .btn-sair não encontrado no DOM.");
  }
});
