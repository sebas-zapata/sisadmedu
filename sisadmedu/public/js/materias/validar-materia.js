document.addEventListener('DOMContentLoaded', () => {

    const descripcion = document.getElementById("descripcion");
    descripcion.addEventListener('input', e => e.target.value = e.target.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, ''));
});