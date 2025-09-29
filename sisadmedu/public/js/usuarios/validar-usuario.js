document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formulario-usuario');
    const documento = document.getElementById('documento');
    const nombres = document.getElementById('nombres');
    const apellidos = document.getElementById('apellidos');
    const correo = document.getElementById('correo_electronico');
    const celular = document.getElementById('celular');

    // --- Restricciones de escritura ---
    documento.addEventListener('input', e => {
        e.target.value = e.target.value.replace(/[^0-9]/g, '');
    });

    nombres.addEventListener('input', e => {
        e.target.value = e.target.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');
    });

    apellidos.addEventListener('input', e => {
        e.target.value = e.target.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');
    });

    correo.addEventListener('input', e => {
        e.target.value = e.target.value.replace(/\s/g, '');
    });

    celular.addEventListener('input', e => {
        e.target.value = e.target.value.replace(/[^0-9]/g, '');
        if (e.target.value.length > 10) {
            e.target.value = e.target.value.slice(0, 10);
        }
    });

});
