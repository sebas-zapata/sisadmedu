document.getElementById("registroForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Evita que el formulario se envíe inmediatamente
    let valid = true;

    // Limpiar mensajes de error previos
    document.querySelectorAll(".error").forEach(span => span.textContent = "");

    // Validación del documento
    const documento = document.getElementById("documento").value.trim();
    if (documento === "" || isNaN(documento)) {
        document.getElementById("docError").textContent = "Documento inválido. Solo números.";
        valid = false;
    }

    // Validación del nombre
    const nombre = document.getElementById("nombre").value.trim();
    if (nombre === "") {
        document.getElementById("nombreError").textContent = "El nombre es obligatorio.";
        valid = false;
    }

    // Validación de apellidos
    const apellidos = document.getElementById("apellidos").value.trim();
    if (apellidos === "") {
        document.getElementById("apellidosError").textContent = "Los apellidos son obligatorios.";
        valid = false;
    }

    // Validación del correo electrónico
    const email = document.getElementById("email").value.trim();
    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if (!email.match(emailPattern)) {
        document.getElementById("emailError").textContent = "Correo electrónico inválido.";
        valid = false;
    }

    // Validación del teléfono
    const telefono = document.getElementById("telefono").value.trim();
    if (telefono === "" || isNaN(telefono) || telefono.length < 10) {
        document.getElementById("telefonoError").textContent = "Teléfono inválido. Debe contener al menos 10 números.";
        valid = false;
    }

    // Validación de la contraseña
    const password = document.getElementById("password").value.trim();
    if (password.length < 8) {
        document.getElementById("passwordError").textContent = "La contraseña debe tener al menos 8 caracteres.";
        valid = false;
    }

    // Validación del rol
    const rol = document.getElementById("rol").value;
    if (rol === "") {
        document.getElementById("rolError").textContent = "Debe seleccionar un rol.";
        valid = false;
    }

    if (valid) {
        // Si todo es válido, enviar el formulario
        alert("Formulario de registro enviado correctamente.");
        // Aquí puedes enviar el formulario o redirigir al usuario
        // document.getElementById("registroForm").submit();
    }
});
