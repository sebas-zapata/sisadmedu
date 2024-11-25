document.getElementById('editForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevenir envío del formulario
    let valid = true;

    // Limpiar errores previos
    document.querySelectorAll('.error').forEach(span => span.textContent = '');

    // Validar Tipo de Documento
    const tipoDoc = document.getElementById('tipo_documento');
    if (tipoDoc.value === '') {
        document.getElementById('tipoDocError').textContent = 'Selecciona un tipo de documento.';
        valid = false;
    }

    // Validar Documento
    const doc = document.getElementById('documento_usuario');
    if (doc.value.trim() === '' || isNaN(doc.value)) {
        document.getElementById("docError").textContent = "Documento inválido. Solo números.";
        valid = false;
    }

    // Validar Nombres
    const nombres = document.getElementById('nombres_usuario');
    if (nombres.value.trim() === '') {
        document.getElementById("nombreError").textContent = "Los nombres son obligatorios.";
        valid = false;
    }

    // Validar Apellidos
    const apellidos = document.getElementById('apellidos_usuario');
    if (apellidos.value.trim() === '') {
        document.getElementById('apellidoError').textContent = 'El apellido es obligatorio.';
        valid = false;
    }

    // Validar Correo Electrónico
    const correo = document.getElementById('correo_electronico_usuario');
    const correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!correoRegex.test(correo.value)) {
        document.getElementById('correoError').textContent = "Correo electrónico inválido.";
        valid = false;
    }

    // Validar Teléfono
    const telefono = document.getElementById('telefono_usuario');
    if (telefono.value.trim() === '' || isNaN(telefono.value)) {
        document.getElementById("telefonoError").textContent = "Teléfono inválido. Debe contener al menos 10 números.";
        valid = false;
    }

    // Validar Rol
    const rol = document.getElementById('id_rol');
    if (rol.value === '') {
        document.getElementById("rolError").textContent = "Debe seleccionar un rol.";
        valid = false;
    }

    if (valid) {
        this.submit();
    }
});
