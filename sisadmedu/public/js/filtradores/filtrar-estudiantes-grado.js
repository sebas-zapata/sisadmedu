document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('filtroNombre');
    const tarjetas = document.querySelectorAll('.columna-estudiante');
    input.addEventListener('input', () => {
        const texto = input.value.toLowerCase();
        tarjetas.forEach(tarjeta => {
            const nombre = tarjeta.dataset.nombre; // Obtenemos el data-nombre
            // Mostramos u ocultamos la tarjeta según coincidencia
            tarjeta.style.display = nombre.includes(texto) ? '' : 'none';
        });
    });
});