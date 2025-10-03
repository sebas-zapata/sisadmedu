document.addEventListener('DOMContentLoaded', function () {
    const botonesEliminar = document.querySelectorAll('.btn-eliminar-materias');

    botonesEliminar.forEach(boton => {
        boton.addEventListener('click', function () {
            const form = this.closest('form');
            const materiaNombre = form.getAttribute('data-materia');

            Swal.fire({
                title: `¿Estás seguro de eliminar la asignatura '${materiaNombre}'?`,
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
