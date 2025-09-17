document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formulario-docente');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        // Obtener valores de campos
        const documento = form.querySelector('[name="documento"]').value.trim();
        const primer_nombre = form.querySelector('[name="primer_nombre"]').value.trim();
        const primer_apellido = form.querySelector('[name="primer_apellido"]').value.trim();
        const correo = form.querySelector('[name="correo_electronico"]').value.trim();
        const materia = form.querySelector('[name="id_materia"]').value;
        const tipoDocumento = form.querySelector('[name="id_tipo_documento"]').value;

        // Validar campos obligatorios
        if (
            documento === '' ||
            primer_nombre === '' ||
            primer_apellido === '' ||
            correo === ''
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
        if (materia === '' || tipoDocumento === '') {
            Swal.fire({
                icon: 'info',
                title: 'Campos faltantes',
                text: 'Selecciona una materia y un tipo de documento.',
                confirmButtonColor: '#461c68'
            });
            return;
        }

        // Validar correo
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
    });

    // Validar que documento solo acepte números
    document.getElementById("documento").addEventListener("keypress", function (e) {
        if (!/[0-9]/.test(e.key)) {
            e.preventDefault(); // bloquea letras y símbolos
        }
    });
});
