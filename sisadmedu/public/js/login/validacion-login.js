document.addEventListener('DOMContentLoaded', () => {

    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('contrasena');

    // Mostrar/ocultar el ojo según si hay texto
    passwordInput.addEventListener('input', () => {
        if (passwordInput.value.length > 0) {
            togglePassword.style.display = 'block';
        } else {
            togglePassword.style.display = 'none';
            passwordInput.setAttribute('type', 'password'); // ocultar contraseña si se borra todo
            togglePassword.classList.add('fa-eye');
            togglePassword.classList.remove('fa-eye-slash');
        }
    });

    togglePassword.addEventListener('click', () => {
        // Cambiar tipo de input entre password y text
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        togglePassword.classList.toggle('fa-eye');
        togglePassword.classList.toggle('fa-eye-slash');
    });

    // Mostrar error de sesión si existe
    const errorDiv = document.getElementById('session-error');
    if (errorDiv) {
        const errorMsg = errorDiv.getAttribute('data-error');
        if (errorMsg) {
            Swal.fire({
                icon: 'error',
                title: 'Acceso denegado',
                text: errorMsg,
                confirmButtonColor: '#461c68',
                confirmButtonText: 'Aceptar',
            });
        }
    }
});
