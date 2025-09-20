// Alerta de éxito con SweetAlert2
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

// Alerta de cambio de contraseña con Bootstrap Toast
document.addEventListener('DOMContentLoaded', function () {
    var toastEl = document.getElementById('toastContrasena');
    if (toastEl) {
        var toast = new bootstrap.Toast(toastEl, { delay: 60000 }); // Aparece 60s
        toast.show();
    }
});
