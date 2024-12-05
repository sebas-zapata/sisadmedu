document.addEventListener("DOMContentLoaded", () => {
  const loginForm = document.getElementById("loginForm");
  const emailInput = document.getElementById("loginEmail");
  const passwordInput = document.getElementById("loginPassword");
  const togglePassword = document.getElementById("togglePassword");

  // Validación en tiempo real para el correo electrónico
  emailInput.addEventListener("input", () => {
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (emailInput.value.match(emailPattern)) {
      emailInput.classList.remove("is-invalid");
      emailInput.classList.add("is-valid");
    } else {
      emailInput.classList.remove("is-valid");
      emailInput.classList.add("is-invalid");
    }
  });


  // Validación del formulario en tiempo real
  loginForm.addEventListener("submit", (e) => {
    e.preventDefault();
    if (!loginForm.checkValidity()) {
      loginForm.classList.add("was-validated");
    } else {
      alert("Formulario enviado correctamente.");
    }
  });
});