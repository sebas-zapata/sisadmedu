document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('filtroMaterias'); // Input de búsqueda
    const filas = document.querySelectorAll('#tabla-materias tbody tr'); // Tabla de materias

    input.addEventListener('input', () => {
        input.value = input.value.replace(/[^a-zA-Z\s]/g, '');
        const texto = input.value.toLowerCase();

        filas.forEach(fila => {
            const descripcion = fila.dataset.nombre.toLowerCase(); // dataset.nombre contiene la descripción de la materia

            if (descripcion.includes(texto)) {
                fila.style.display = '';
            } else {
                fila.style.display = 'none';
            }
        });
    });
});
