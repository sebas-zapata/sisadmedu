document.addEventListener("DOMContentLoaded", () => {
    const datosDiv = document.getElementById("datos-dashboard");
    if (!datosDiv) return;

    // Extraer datos del div
    const datos = {
        estudiantes: parseInt(datosDiv.dataset.estudiantes, 10),
        usuarios: parseInt(datosDiv.dataset.usuarios, 10),
        docentes: parseInt(datosDiv.dataset.docentes, 10),
        grados: parseInt(datosDiv.dataset.grados, 10),
    };

    // Etiquetas y valores comunes
    const etiquetas = ["Estudiantes", "Usuarios", "Docentes", "Grados"];
    const valores = [
        datos.estudiantes,
        datos.usuarios,
        datos.docentes,
        datos.grados,
    ];
    const colores = ["#461c68", "#7E08CA", "#333", "white"];

    // Gráfico de Líneas
    new Chart(document.getElementById("barChart"), {
        type: "doughnut",
        data: {
            labels: etiquetas,
            datasets: [{
                label: "Totales",
                data: valores,
                backgroundColor: colores,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            }
        }
    });

    // Gráfico de Pastel
    new Chart(document.getElementById("pieChart"), {
        type: "pie",
        data: {
            labels: etiquetas,
            datasets: [{
                data: valores,
                backgroundColor: colores,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: "bottom" }
            }
        }
    });

    // Gráfico de Líneas
    new Chart(document.getElementById("lineChart"), {
        type: "line",
        data: {
            labels: ["Estudiantes", "Usuarios", "Docentes", "Grados"],
            datasets: [{
                label: "Evolución",
                data: [
                    datos.estudiantes,
                    datos.usuarios,
                    datos.docentes,
                    datos.grados
                ],
                borderColor: "#461c68",
                backgroundColor: "white",
                fill: true,
                tension: 0.3 // suaviza las líneas
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: "bottom" }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

});
