document.addEventListener('DOMContentLoaded', function () {
    const divExito = document.getElementById('session-success');
    if (!divExito) return;

    const mensaje = divExito.dataset.mensaje;
    if (!mensaje) return;

    let titulo = '¡Éxito!';
    let icono = 'success';

    if (mensaje.includes('eliminado')) {
        titulo = 'Eliminado';
    } else if (mensaje.includes('actualizado')) {
        titulo = 'Actualizado';
    } else if (mensaje.includes('creado')) {
        titulo = 'Creado';
    }

    Swal.fire({
        title: titulo,
        text: mensaje,
        icon: icono,
        confirmButtonColor: '#461c68',
        confirmButtonText: 'Aceptar'
    });
});
