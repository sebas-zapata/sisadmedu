document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formulario-usuario');

    form.addEventListener('submit', function (e) {
        const documento = form.documento.value.trim();
        const nombres = form.nombres.value.trim();
        const apellidos = form.apellidos.value.trim();
        const correo = form.correo_electronico.value.trim();
        const telefono = form.telefono.value.trim();
        const contrasena = form.contrasena.value;

        // Mensajes simples
        if (documento === '' || nombres === '' || apellidos === '' ||
            correo === '' || telefono === '' || contrasena === '') {
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

        if (!correo.includes('@') || !correo.includes('.')) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Correo inválido',
                text: 'Por favor ingresa un correo electrónico válido.',
                confirmButtonColor: '#461c68'
            });
            return;
        }

        if (contrasena.length < 6) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Contraseña muy corta',
                text: 'La contraseña debe tener al menos 6 caracteres.',
                confirmButtonColor: '#461c68'
            });
            return;
        }
    });
});
