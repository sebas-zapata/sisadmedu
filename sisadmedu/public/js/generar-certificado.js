const input = document.getElementById('codigo');

// Prefijo fijo
const prefijo = "MAT-2025-";

// Valor inicial completo
input.value = prefijo + "0000";

// Cuando el usuario escribe:
input.addEventListener('input', function () {

    // Si intenta borrar o modificar el prefijo, lo restauramos
    if (!input.value.startsWith(prefijo)) {
        input.value = prefijo + input.value.replace(/\D/g, "").slice(-4);
    }

    // Tomar solo los últimos 4 dígitos permitidos
    let ultimos4 = input.value.replace(prefijo, "").replace(/\D/g, "").slice(0, 5);

    // Reconstruir el valor
    input.value = prefijo + ultimos4;
});

document.getElementById('generar-certificado').addEventListener('click', function () {
    Swal.fire({
        icon: 'info',
        title: 'Generando certificado...',
        text: 'El certificado se está descargando. Revisa tu sección de descargas.',
        timer: 4000, // tiempo en milisegundos (2 segundos)
        showConfirmButton: false,
        willClose: () => {
            // Opcional: código que quieres ejecutar al cerrar
        }
    });
});
