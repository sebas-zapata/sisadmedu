document.addEventListener('DOMContentLoaded', function () {
    const botonesEliminar = document.querySelectorAll('.btn-eliminar-asignacion');

    botonesEliminar.forEach(boton => {
        boton.addEventListener('click', function () {
            const form = this.closest('form');
            const docenteNombre = form.getAttribute('data-docente');
            const docenteMateria = form.getAttribute('data-materia');

            Swal.fire({
                title: `¿Estás seguro de eliminar la asignación de ${docenteNombre} en la materia ${docenteMateria}?`,
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
