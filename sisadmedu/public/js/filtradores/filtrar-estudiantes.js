document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('filtroEstudiantes');
    const filas = document.querySelectorAll('#tabla-estudiantes tbody tr');

    input.addEventListener('input', () => {
        // Solo números
        input.value = input.value.replace(/[^0-9]/g, '');
        const texto = input.value.toLowerCase();
        let coincidencias = 0;

        filas.forEach(fila => {
             const documento = fila.querySelector('td:nth-child(3)').textContent.toLowerCase();

            if (documento.includes(texto)) {
                fila.style.display = '';
                coincidencias++;
            } else {
                fila.style.display = 'none';
            }
        });
    });
});
