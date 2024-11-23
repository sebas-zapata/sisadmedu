function eliminar(event, url) {
    event.preventDefault(); // Prevenir que el enlace se ejecute directamente

    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás revertir esta acción.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#461c68;',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirigir a la URL de eliminación si se confirma
            window.location.href = url;
        }
    });
}