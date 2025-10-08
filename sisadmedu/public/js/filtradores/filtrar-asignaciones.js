document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('filtroAsignaciones');
    const filas = document.querySelectorAll('#tabla-asignaciones tbody tr');

    input.addEventListener('input', () => {
        input.value = input.value.replace(/[^a-zA-Z\s]/g, '');
        const texto = input.value.toLowerCase().trim();
        let coincidencias = 0;

        filas.forEach(fila => {
            const docente = fila.dataset.docente.toLowerCase();
            const materia = fila.dataset.materia.toLowerCase();

            // Coincidencia por nombre del docente o por materia
            if (docente.includes(texto) || materia.includes(texto)) {
                fila.style.display = '';
                coincidencias++;
            } else {
                fila.style.display = 'none';
            }
        });
    });
});
