document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('filtroGrados');
    const filas = document.querySelectorAll('#tabla-grados tbody tr');
    let mensajeNoEncontrado;

    input.addEventListener('input', () => {
        // Solo letras y espacios
        const texto = input.value.toLowerCase();
        let coincidencias = 0;

        filas.forEach(fila => {
            const nombreCompleto = fila.dataset.nombre;
            if(nombreCompleto.includes(texto)) {
                fila.style.display = '';
                coincidencias++;
            } else {
                fila.style.display = 'none';
            }
        });
    });
});
