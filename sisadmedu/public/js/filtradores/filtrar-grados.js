document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('filtroGrados');
    const filas = document.querySelectorAll('#tabla-grados tbody tr');

    input.addEventListener('input', () => {
        // Permitir solo números
        input.value = input.value.replace(/[^0-9]/g, '');
        const texto = input.value.toLowerCase();
        let coincidencias = 0;

        filas.forEach(fila => {
            const nombreGrado = fila.dataset.nombre.toLowerCase();

            if (nombreGrado.includes(texto)) {
                fila.style.display = '';
                coincidencias++;
            } else {
                fila.style.display = 'none';
            }
        });
    });
});
