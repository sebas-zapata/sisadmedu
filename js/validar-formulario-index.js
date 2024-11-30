document.getElementById("formularioContacto").addEventListener("submit", function (event) {
    let isValid = true;

    // Limpiar mensajes de error
    document.querySelectorAll(".error").forEach(span => span.textContent = "");
    document.querySelectorAll("input, textarea").forEach(field => field.classList.remove("error"));

    // Obtener valores de los campos
    const nombreCompleto = document.getElementById("nombreCompleto").value.trim();
    const correoElectronico = document.getElementById("correoElectronico").value.trim();
    const mensaje = document.getElementById("mensaje").value.trim();

    // Validar nombre completo
    if (nombreCompleto === "") {
        isValid = false;
        document.getElementById("errorNombreCompleto").textContent = "El nombre completo es obligatorio.";
        document.getElementById("nombreCompleto").classList.add("error");
    }

    // Validar correo electrónico
    if (correoElectronico === "") {
        isValid = false;
        document.getElementById("errorCorreoElectronico").textContent = "El correo electrónico es obligatorio.";
        document.getElementById("correoElectronico").classList.add("error");
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correoElectronico)) {
        isValid = false;
        document.getElementById("errorCorreoElectronico").textContent = "Ingrese un correo electrónico válido.";
        document.getElementById("correoElectronico").classList.add("error");
    }

    // Validar mensaje
    if (mensaje === "") {
        isValid = false;
        document.getElementById("errorMensaje").textContent = "El mensaje es obligatorio.";
        document.getElementById("mensaje").classList.add("error");
    }

    // Si hay errores, evitar el envío
    if (!isValid) {
        event.preventDefault();
    } else {
        // Mostrar SweetAlert y permitir el envío
        event.preventDefault(); // Evitar envío inmediato para mostrar SweetAlert primero
        Swal.fire({
            title: "¡Formulario enviado!",
            text: "Gracias por contactarnos.",
            icon: "success",
            confirmButtonText: "Aceptar"
        }).then(() => {
            // Enviar el formulario manualmente después de SweetAlert
            document.getElementById("formularioContacto").submit();
        });
    }
});