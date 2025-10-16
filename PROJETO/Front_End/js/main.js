const form = document.getElementById('tecidoForm');
const notification = document.getElementById('notification');

form.addEventListener('submit', function(event) {
  event.preventDefault(); // Evita que a página recarregue

  // Mostra a notificação
  notification.classList.add('show');

  // Esconde a notificação após 3 segundos
  setTimeout(() => {
    notification.classList.remove('show');
  }, 3000);

  // Limpa o formulário
  form.reset();

  // Aqui você pode adicionar a lógica para salvar os dados no backend
});
