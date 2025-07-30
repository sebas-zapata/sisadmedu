document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formulario-usuario');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        // Obtener valores de campos
        const documento = form.querySelector('[name="documento"]').value.trim();
        const nombres = form.querySelector('[name="nombres"]').value.trim();
        const apellidos = form.querySelector('[name="apellidos"]').value.trim();
        const correo = form.querySelector('[name="correo_electronico"]').value.trim();
        const telefono = form.querySelector('[name="telefono"]').value.trim();
        const contrasena = form.querySelector('[name="contrasena"]').value;

        const rolSelect = form.querySelector('[name="rol_id"]');
        const tipoDocSelect = form.querySelector('[name="tipo_documento_id"]');

        // Validar campos obligatorios
        if (
            documento === '' ||
            nombres === '' ||
            apellidos === '' ||
            correo === '' ||
            telefono === ''
        ) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Campos requeridos',
                text: 'Por favor completa todos los campos obligatorios.',
                confirmButtonColor: '#461c68',
                confirmButtonText: 'Aceptar'
            });
            return;
        }

        // Validar selects requeridos
        if (!rolSelect.value || !tipoDocSelect.value) {
            e.preventDefault();
            Swal.fire({
                icon: 'info',
                title: 'Campos faltantes',
                text: 'Selecciona un rol y un tipo de documento.',
                confirmButtonColor: '#461c68'
            });
            return;
        }

        // Validar formato de correo electrónico
        const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!regexCorreo.test(correo)) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Correo inválido',
                text: 'Por favor ingresa un correo electrónico válido.',
                confirmButtonColor: '#461c68'
            });
            return;
        }

        // Validar contraseña solo si se ingresó
        if (contrasena.length > 0 && contrasena.length < 6) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Contraseña muy corta',
                text: 'La nueva contraseña debe tener al menos 6 caracteres.',
                confirmButtonColor: '#461c68'
            });
            return;
        }
    });
});
