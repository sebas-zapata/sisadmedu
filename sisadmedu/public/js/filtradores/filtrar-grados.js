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

        // Mensaje dinámico
        const tabla = document.querySelector('#tabla-grados tbody');
        if(coincidencias === 0 && texto !== '') {
            if(!mensajeNoEncontrado) {
                mensajeNoEncontrado = document.createElement('tr');
                mensajeNoEncontrado.innerHTML = `<td colspan="5" class="text-center text-muted"><i class="fas fa-layer-group"></i> No se encontraron grados.</td>`;
                tabla.appendChild(mensajeNoEncontrado);
            }
        } else if(mensajeNoEncontrado) {
            mensajeNoEncontrado.remove();
            mensajeNoEncontrado = null;
        }
    });
});
