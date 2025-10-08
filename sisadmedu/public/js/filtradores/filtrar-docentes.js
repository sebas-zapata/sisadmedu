document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('filtroDocentes');
    const filas = document.querySelectorAll('#tabla-docentes tbody tr');

    input.addEventListener('input', () => {
        // Solo números
        input.value = input.value.replace(/[^0-9]/g, '');
        const texto = input.value.toLowerCase();
        let coincidencias = 0;

        filas.forEach(fila => {
            const documento = fila.dataset.documento; // ahora buscamos por documento
            if (documento.includes(texto)) {
                fila.style.display = '';
                coincidencias++;
            } else {
                fila.style.display = 'none';
            }
        });
    });
});