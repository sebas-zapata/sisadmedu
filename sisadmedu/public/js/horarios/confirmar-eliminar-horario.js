document.addEventListener('DOMContentLoaded', function () {
    const botonesEliminar = document.querySelectorAll('.btn-eliminar-horario');

    botonesEliminar.forEach(boton => {
        boton.addEventListener('click', function () {
            const form = this.closest('form');
            const nombreGrado = form.getAttribute('data-horario');

            Swal.fire({
                title: `¿Estás seguro de eliminar el horario del grado '${nombreGrado}'?`,
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
