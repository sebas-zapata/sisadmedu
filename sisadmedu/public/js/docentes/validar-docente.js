document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formulario-docente');
    if (!form) return;

    form.addEventListener('submit', (e) => {
        // Obtener los valores de los campos
        const codigo_docente = form.querySelector('[name="codigo_docente"]').value.trim();
        const documento = form.querySelector('[name="documento"]').value.trim();
        const primer_nombre = form.querySelector('[name="primer_nombre"]').value.trim();
        const segundo_nombre = form.querySelector('[name="segundo_nombre"]').value.trim();
        const primer_apellido = form.querySelector('[name="primer_apellido"]').value.trim();
        const segundo_apellido = form.querySelector('[name="segundo_apellido"]').value.trim();
        const correo_electronico = form.querySelector('[name="correo_electronico"]').value;

        const materiaSelect = form.querySelector('[name="id_materia"]');
<<<<<<< HEAD
        const tipoDocumentoSelect = form.querySelector('[name="id_tipo_documento"]');
=======
        const tipoDocumentoSelect = form.querySelector('[name="tipo_documento_id"]');
>>>>>>> feature/nueva-funcionalidad

        if (codigo_docente === "" || documento === "" || primer_nombre === "" || segundo_nombre === "" || primer_apellido === "" || segundo_apellido === "") {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Campos requeridos',
                text: 'Por favor completa todos los campos obligatorios.',
                confirmButtonColor: '#461c68',
                confirmButtonText: 'Aceptar'
            });
            return;
        }

        // Validar formato de correo electrónico
        const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!regexCorreo.test(correo_electronico || correo_electronico === "")) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Correo inválido',
                text: 'Por favor ingresa un correo electrónico o uno válido.',
                confirmButtonColor: '#461c68'
            });
            return;
        }

        // Validar selects requeridos
        if (!materiaSelect.value || !tipoDocumentoSelect.value) {
            e.preventDefault();
            Swal.fire({
                icon: 'info',
                title: 'Campos faltantes',
                text: `Selecciona una materia y un tipo de documento para asignarlos al docente ${primer_nombre}.`,
                confirmButtonColor: '#461c68'
            });
            return;
        }
    })
})