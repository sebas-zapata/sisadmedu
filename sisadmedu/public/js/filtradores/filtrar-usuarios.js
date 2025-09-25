document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('filtroUsuarios');
    const filas = document.querySelectorAll('#usuarios tbody tr');
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
        const tabla = document.querySelector('#usuarios tbody');
        if(coincidencias === 0 && texto !== '') {
            if(!mensajeNoEncontrado) {
                mensajeNoEncontrado = document.createElement('tr');
                mensajeNoEncontrado.innerHTML = `<td colspan="7" class="text-center text-muted"><i class="fas fa-user-slash"></i> No se encontraron usuarios.</td>`;
                tabla.appendChild(mensajeNoEncontrado);
            }
        } else if(mensajeNoEncontrado) {
            mensajeNoEncontrado.remove();
            mensajeNoEncontrado = null;
        }
    });
});
