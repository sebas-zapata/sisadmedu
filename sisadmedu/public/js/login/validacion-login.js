document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('loginForm');

    // Validación del formulario
    form.addEventListener('submit', function (e) {
        const correo = document.getElementById('correo_electronico').value.trim();
        const contrasena = document.getElementById('contrasena').value.trim();
        const correoValido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo);

        if (!correo || !contrasena) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Campos requeridos',
                text: 'Por favor completa todos los campos.',
                confirmButtonColor: '#461c68'
            });
        } else if (!correoValido) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Correo inválido',
                text: 'Ingresa un correo electrónico válido.',
                confirmButtonColor: '#461c68'
            });
        } else if (contrasena.length < 6) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Contraseña muy corta',
                text: 'La contraseña debe tener al menos 6 caracteres.',
                confirmButtonColor: '#461c68'
            });
        }
    });

    // Mostrar error de sesión si existe
    const errorDiv = document.getElementById('session-error');
    if (errorDiv) {
        const errorMsg = errorDiv.getAttribute('data-error');
        if (errorMsg) {
            Swal.fire({
                icon: 'error',
                title: 'Error de inicio de sesión',
                text: errorMsg,
                confirmButtonColor: '#461c68'
            });
        }
    }
});
