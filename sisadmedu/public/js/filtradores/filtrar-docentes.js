document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('filtroDocentes');
    const filas = document.querySelectorAll('#tabla-docentes tbody tr');
    let mensajeNoEncontrado;

    input.addEventListener('input', () => {
        // Solo letras y espacios
        input.value = input.value.replace(/[^A-Za-z\s]/g, '');
        const texto = input.value.toLowerCase();
        let coincidencias = 0;

        filas.forEach(fila => {
            const nombreCompleto = fila.dataset.nombre; // nombre + apellido
            if(nombreCompleto.includes(texto)) {
                fila.style.display = '';
                coincidencias++;
            } else {
                fila.style.display = 'none';
            }
        });

        // Mensaje dinámico
        const tabla = document.querySelector('#tabla-docentes tbody');
        if(coincidencias === 0 && texto !== '') {
            if(!mensajeNoEncontrado) {
                mensajeNoEncontrado = document.createElement('tr');
                mensajeNoEncontrado.innerHTML = `<td colspan="6" class="text-center text-muted"><i class="fas fa-user-slash"></i> No se encontraron docentes.</td>`;
                tabla.appendChild(mensajeNoEncontrado);
            }
        } else if(mensajeNoEncontrado) {
            mensajeNoEncontrado.remove();
            mensajeNoEncontrado = null;
        }
    });
});
