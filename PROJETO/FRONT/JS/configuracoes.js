document.addEventListener("DOMContentLoaded", () => {
  const btnEditar = document.querySelector(".btn-editar");
  const inputs = document.querySelectorAll(".config-card form input");

  if (!btnEditar || inputs.length === 0) return;


  inputs.forEach(input => input.disabled = true);

  // Alternar entre Editar / Salvar
  btnEditar.addEventListener("click", () => {
    const modoEdicao = btnEditar.textContent === "Editar";

    if (modoEdicao) {
      // Ativa edição
      inputs.forEach(input => {
        input.disabled = false;
        input.classList.add("editavel");
      });
      btnEditar.textContent = "Salvar";
      btnEditar.style.background = "#198754"; // verde
    } else {
      // Desativa edição e simula salvamento
      inputs.forEach(input => {
        input.disabled = true;
        input.classList.remove("editavel");
      });
      btnEditar.textContent = "Editar";
      btnEditar.style.background = "#111";

      alert("Informações salvas com sucesso ✅");
    }
  });
});
