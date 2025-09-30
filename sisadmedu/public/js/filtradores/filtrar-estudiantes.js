document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('filtroEstudiantes');
    const filas = document.querySelectorAll('#tabla-estudiantes tbody tr');
    let mensajeNoEncontrado;

    input.addEventListener('input', () => {
        // Permitir solo números
        input.value = input.value.replace(/[^0-9]/g, '');
        const texto = input.value.toLowerCase();
        let coincidencias = 0;

        filas.forEach(fila => {
            const documento = fila.dataset.documento.toLowerCase();

            if (documento.includes(texto)) {
                fila.style.display = '';
                coincidencias++;
            } else {
                fila.style.display = 'none';
            }
        });
    });
});
