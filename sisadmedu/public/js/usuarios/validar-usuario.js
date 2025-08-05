document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formulario-usuario');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        // Obtener valores de campos con querySelector (más confiable)
        const documento = form.querySelector('[name="documento"]').value.trim();
        const nombres = form.querySelector('[name="nombres"]').value.trim();
        const apellidos = form.querySelector('[name="apellidos"]').value.trim();
        const correo = form.querySelector('[name="correo_electronico"]').value.trim();
        const telefono = form.querySelector('[name="telefono"]').value.trim();
        const contrasena = form.querySelector('[name="contrasena"]').value;
        const rol = form.querySelector('[name="rol_id"]').value;
        const tipoDocumento = form.querySelector('[name="tipo_documento_id"]').value;

        // Validar campos obligatorios
        if (
            documento === '' ||
            nombres === '' ||
            apellidos === '' ||
            correo === '' ||
            telefono === ''
        ) {
            Swal.fire({
                icon: 'warning',
                title: 'Campos requeridos',
                text: 'Por favor completa todos los campos obligatorios.',
                confirmButtonColor: '#461c68',
                confirmButtonText: 'Aceptar',
            });
            return;
        }

        // Validar selects
        if (rol === '' || tipoDocumento === '') {
            Swal.fire({
                icon: 'info',
                title: 'Campos faltantes',
                text: 'Selecciona un rol y un tipo de documento.',
                confirmButtonColor: '#461c68'
            });
            return;
        }

        // Validar correo
        const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!regexCorreo.test(correo)) {
            Swal.fire({
                icon: 'warning',
                title: 'Correo inválido',
                text: 'Por favor ingresa un correo electrónico válido.',
                confirmButtonColor: '#461c68'
            });
            return;
        }

        // Validar contraseña si se ingresó
        if (contrasena.length > 0 && contrasena.length < 6) {
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
