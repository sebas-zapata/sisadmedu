document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formulario-grado');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        const nivel = form.querySelector('[name="nivel_grado"]').value.trim();
        const grupo = form.querySelector('[name="grupo_grado"]').value.trim();

        // Validar que no estén vacíos
        if (nivel === '' || grupo === '') {
            Swal.fire({
                icon: 'warning',
                title: 'Campos requeridos',
                text: 'Debes seleccionar el nivel y el grupo.',
                confirmButtonColor: '#461c68',
                confirmButtonText: 'Aceptar',
            });
            return;
        }

        // Validación: nivel numérico mayor a 0
        if (isNaN(nivel) || parseInt(nivel) <= 0) {
            Swal.fire({
                icon: 'error',
                title: 'Nivel inválido',
                text: 'El nivel debe ser un número mayor a 0.',
                confirmButtonColor: '#461c68'
            });
            return;
        }

        // Validación: grupo numérico mayor a 0
        if (isNaN(grupo) || parseInt(grupo) <= 0) {
            Swal.fire({
                icon: 'error',
                title: 'Grupo inválido',
                text: 'El grupo debe ser un número mayor a 0.',
                confirmButtonColor: '#461c68'
            });
            return;
        }
    });
});
