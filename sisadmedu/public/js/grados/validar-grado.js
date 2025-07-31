document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formulario-grado');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        // Obtener el valor del campo nombre_grado
        const nombreGrado = form.querySelector('[name="nombre_grado"]').value.trim();

        // Validar campo obligatorio
        if (nombreGrado === '') {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Campo requerido',
                text: 'Por favor completa el campo de nombre del grado.',
                confirmButtonColor: '#461c68',
                confirmButtonText: 'Aceptar'
            });
            return;
        }
    });
});