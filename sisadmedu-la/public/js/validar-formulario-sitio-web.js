document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formularioContacto');

    form.addEventListener('submit', function (e) {
        e.preventDefault(); // Siempre prevenir envío

        const nombre = document.getElementById('nombreCompleto').value.trim();
        const correo = document.getElementById('correoElectronico').value.trim();
        const mensaje = document.getElementById('mensaje').value.trim();

        const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (nombre === '' || correo === '' || mensaje === '') {
            Swal.fire({
                icon: 'warning',
                title: 'Campos incompletos',
                text: 'Por favor completa todos los campos.',
                confirmButtonColor: '#461c68'
            });
            return;
        }

        if (!regexCorreo.test(correo)) {
            Swal.fire({
                icon: 'error',
                title: 'Correo inválido',
                text: 'Ingresa un correo electrónico válido.',
                confirmButtonColor: '#461c68'
            });
            return;
        }
        // ✅ Mostrar mensaje exitoso
        Swal.fire({
            icon: 'success',
            title: 'Formulario completo',
            text: 'Todos los campos se han llenado correctamente.',
            confirmButtonColor: '#461c68'
        }).then(() => {
            // ✅ Limpiar campos después de cerrar la alerta
            form.reset();
        });
    });
});