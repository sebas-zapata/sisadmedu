document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('filtroUsuarios');
    const selectRol = document.getElementById('filtroRol'); // nuevo select
    const filas = document.querySelectorAll('#usuarios tbody tr');

    function filtrar() {
        // Solo números en el input
        input.value = input.value.replace(/[^0-9]/g, '');
        const texto = input.value.toLowerCase();
        const rolSeleccionado = selectRol.value.toLowerCase();
        let coincidencias = 0;

        filas.forEach(fila => {
            const documento = fila.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const rol = fila.querySelector('td:nth-child(6)').textContent.toLowerCase();

            const coincideDocumento = documento.includes(texto);
            const coincideRol = rolSeleccionado === '' || rol === rolSeleccionado;

            if (coincideDocumento && coincideRol) {
                fila.style.display = '';
                coincidencias++;
            } else {
                fila.style.display = 'none';
            }
        });
    }

    input.addEventListener('input', filtrar);
    selectRol.addEventListener('change', filtrar); // filtrar al cambiar rol
});
