document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formulario-docente');

    // --- Campos ---
    const documento = document.getElementById('documento');
    const primer_nombre = document.getElementById('primer_nombre');
    const segundo_nombre = document.getElementById('segundo_nombre');
    const primer_apellido = document.getElementById('primer_apellido');
    const segundo_apellido = document.getElementById('segundo_apellido');
    const correo = document.getElementById('correo_electronico');
    const celular = document.getElementById('celular');
    const direccion = document.getElementById('direccion');
    const especializacion = document.getElementById('especializacion');
    const anios_experiencia = document.getElementById('anios_experiencia');
    const telefono = document.getElementById('telefono');

    // --- Restricciones de escritura ---
    documento.addEventListener('input', e => e.target.value = e.target.value.replace(/[^0-9]/g, ''));
    primer_nombre.addEventListener('input', e => e.target.value = e.target.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, ''));
    segundo_nombre.addEventListener('input', e => e.target.value = e.target.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, ''));
    primer_apellido.addEventListener('input', e => e.target.value = e.target.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, ''));
    segundo_apellido.addEventListener('input', e => e.target.value = e.target.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, ''));
    celular.addEventListener('input', e => e.target.value = e.target.value.replace(/[^0-9]/g, '').slice(0, 10));
    telefono.addEventListener('input', e => e.target.value = e.target.value.replace(/[^0-9]/g, '').slice(0, 10));
    anios_experiencia.addEventListener('input', e => e.target.value = e.target.value.replace(/[^0-9]/g, ''));
    correo.addEventListener('input', e => e.target.value = e.target.value.replace(/\s/g, ''));
    direccion.addEventListener('input', e => e.target.value = e.target.value.replace(/[^A-Za-z0-9ÁÉÍÓÚáéíóúÑñ\s\-\#]/g, ''));
    especializacion.addEventListener('input', e => e.target.value = e.target.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, ''));
});
