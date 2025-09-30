document.addEventListener('DOMContentLoaded', function () {
    const botonesEliminar = document.querySelectorAll('.btn-eliminar-estudiantes');

    botonesEliminar.forEach(boton => {
        boton.addEventListener('click', function () {
            const form = this.closest('form');
            const estudianteNombre = form.getAttribute('data-estudiante');

            Swal.fire({
                title: `¿Estás seguro de eliminar al estudiante '${estudianteNombre}'?`,
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#461c68',
                cancelButtonColor: '#666',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
