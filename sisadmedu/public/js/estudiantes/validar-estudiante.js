document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formulario-estudiante');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        // Obtener valores
        const documento = form.querySelector('[name="documento_estudiante"]').value.trim();
        const primerNombre = form.querySelector('[name="primer_nombre_estudiante"]').value.trim();
        const primerApellido = form.querySelector('[name="primer_apellido_estudiante"]').value.trim();
        const edad = form.querySelector('[name="edad_estudiante"]').value.trim();
        const fechaNacimiento = form.querySelector('[name="fecha_nacimiento_estudiante"]').value.trim();
        const correo = form.querySelector('[name="correo_electronico_estudiante"]').value.trim();
        const grado = form.querySelector('[name="id_grado"]').value;
        const tipoDocumento = form.querySelector('[name="id_tipo_documento"]').value;

        // Validar campos obligatorios
        if (
            documento === '' ||
            primerNombre === '' ||
            primerApellido === '' ||
            edad === '' ||
            fechaNacimiento === ''
        ) {
            Swal.fire({
                icon: 'warning',
                title: 'Campos requeridos',
                text: 'Por favor completa todos los campos obligatorios.',
                confirmButtonColor: '#461c68',
                confirmButtonText: 'Aceptar',
            });
            return;
        }

        // Validar selects
        if (grado === '' || tipoDocumento === '') {
            Swal.fire({
                icon: 'info',
                title: 'Campos faltantes',
                text: 'Selecciona un grado y un tipo de documento.',
                confirmButtonColor: '#461c68'
            });
            return;
        }

        // Validar edad
        if (isNaN(edad) || edad < 3 || edad > 100) {
            Swal.fire({
                icon: 'warning',
                title: 'Edad inválida',
                text: 'Por favor ingresa una edad válida entre 3 y 100 años.',
                confirmButtonColor: '#461c68'
            });
            return;
        }

        // Validar correo si se ingresó
        if (correo.length > 0) {
            const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!regexCorreo.test(correo)) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Correo inválido',
                    text: 'Por favor ingresa un correo electrónico válido.',
                    confirmButtonColor: '#461c68'
                });
                return;
            }
        }
    });

    // Restringir solo números en documento, celular y teléfono
    ["documento_estudiante", "celular_estudiante", "telefono_estudiante", "edad_estudiante"].forEach(id => {
        const input = document.getElementById(id);
        if (input) {
            input.addEventListener("keypress", function (e) {
                if (!/[0-9]/.test(e.key)) {
                    e.preventDefault();
                }
            });
        }
    });
});
