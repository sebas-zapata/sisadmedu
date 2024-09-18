document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Evita que el formulario se envíe inmediatamente
    let valid = true;

    // Limpiar mensajes de error previos
    document.querySelectorAll(".error").forEach(span => span.textContent = "");

    // Validación del correo electrónico
    const email = document.getElementById("email-login").value.trim();
    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if (!email.match(emailPattern)) {
        document.getElementById("emailLoginError").textContent = "Correo electrónico inválido.";
        valid = false;
    }

    // Validación de la contraseña
    const password = document.getElementById("password-login").value.trim();
    if (password.length < 8) {
        document.getElementById("passwordLoginError").textContent = "La contraseña debe tener al menos 8 caracteres.";
        valid = false;
    }

    if (valid) {
        // Si todo es válido, enviar el formulario
        alert("Inicio de sesión exitoso.");
        // Aquí puedes enviar el formulario o redirigir al usuario
        // document.getElementById("loginForm").submit();
    }
});
