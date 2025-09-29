document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formulario-estudiante');

    // Campos
    const documento = document.getElementById('documento_estudiante');
    const nombres1 = document.getElementById('primer_nombre_estudiante');
    const nombres2 = document.getElementById('segundo_nombre_estudiante');
    const apellidos1 = document.getElementById('primer_apellido_estudiante');
    const apellidos2 = document.getElementById('segundo_apellido_estudiante');
    const edad = document.getElementById('edad_estudiante');
    const celular = document.getElementById('celular_estudiante');
    const telefono = document.getElementById('telefono_estudiante');
    const correo = document.getElementById('correo_electronico_estudiante');
    const direccion = document.getElementById('direccion_estudiante');

    // --- Restricciones de escritura ---
    documento.addEventListener('input', e => e.target.value = e.target.value.replace(/[^0-9]/g, ''));
    nombres1.addEventListener('input', e => e.target.value = e.target.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, ''));
    nombres2.addEventListener('input', e => e.target.value = e.target.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, ''));
    apellidos1.addEventListener('input', e => e.target.value = e.target.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, ''));
    apellidos2.addEventListener('input', e => e.target.value = e.target.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, ''));
    edad.addEventListener('input', e => e.target.value = e.target.value.replace(/[^0-9]/g, ''));
    celular.addEventListener('input', e => e.target.value = e.target.value.replace(/[^0-9]/g, '').slice(0, 10));
    telefono.addEventListener('input', e => e.target.value = e.target.value.replace(/[^0-9]/g, '').slice(0, 10));
    correo.addEventListener('input', e => e.target.value = e.target.value.replace(/\s/g, ''));
    direccion.addEventListener('input', e => e.target.value = e.target.value.replace(/[^A-Za-z0-9ÁÉÍÓÚáéíóúÑñ\s\-\#]/g, ''));
});
