
// Seleciona o botão e o corpo
const toggleButton = document.getElementById('toggleMode');
const body = document.body;

// Função para alternar entre modos
function toggleMode() {
  body.classList.toggle('dark-mode');
  localStorage.setItem("mode", body.classList.contains('dark-mode') ? "dark-mode" : "light-mode");
  toggleButton.textContent = body.classList.contains('dark-mode') ? "Mudar para Claro" : "Mudar para Escuro";
}

// Define o modo inicial com base no sistema ou salva no localStorage
window.onload = () => {
  const prefersDarkScheme = window.matchMedia("(prefers-color-scheme: dark)").matches;
  const storedMode = localStorage.getItem("mode");
  if (storedMode) {
    body.classList.add(storedMode);
  } else {
    body.classList.add(prefersDarkScheme ? "dark-mode" : "light-mode");
  }
  toggleButton.textContent = body.classList.contains('dark-mode') ? "Mudar para Claro" : "Mudar para Escuro";
};

// Adiciona evento de clique ao botão
toggleButton.addEventListener('click', toggleMode);