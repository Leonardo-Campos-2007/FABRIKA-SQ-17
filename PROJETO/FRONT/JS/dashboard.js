// Seleciona todos os botões de filtro
const botoesFiltro = document.querySelectorAll('.filter-btn');

// Função para atualizar o estado ativo e navegar
botoesFiltro.forEach(botao => {
  botao.addEventListener('click', () => {
    // Remove o estado ativo de todos
    botoesFiltro.forEach(b => b.classList.remove('active'));

    // Adiciona o estado ativo ao botão clicado
    botao.classList.add('active');

    // Obtém o texto do botão e redireciona
    const textoBotao = botao.textContent.trim();

    if (textoBotao === 'Por dia') {
      window.location.href = 'dashboard.html';
    } else if (textoBotao === 'Por semana') {
      window.location.href = 'dashboard_PorSemana.html';
    } else if (textoBotao === 'Por mês') {
      window.location.href = 'dashboard_PorMes.html';
    }
  });
});

// Mantém o botão ativo correto com base na página atual
window.addEventListener('DOMContentLoaded', () => {
  const url = window.location.href;

  botoesFiltro.forEach(botao => {
    const textoBotao = botao.textContent.trim();

    if (
      (url.includes('dashboard.html') && textoBotao === 'Por dia') ||
      (url.includes('dashboard_PorSemana.html') && textoBotao === 'Por semana') ||
      (url.includes('dashboard_PorMes.html') && textoBotao === 'Por mês')
    ) {
      botao.classList.add('active');
    } else {
      botao.classList.remove('active');
    }
  });
});

