document.addEventListener("DOMContentLoaded", () => {
    const datosDiv = document.getElementById("datos-dashboard");
    if (!datosDiv) return;

    // Extraer datos del div
    const datos = {
        estudiantes: parseInt(datosDiv.dataset.estudiantes, 10),
        usuarios: parseInt(datosDiv.dataset.usuarios, 10),
        docentes: parseInt(datosDiv.dataset.docentes, 10),
        grados: parseInt(datosDiv.dataset.grados, 10),
        horarios: parseInt(datosDiv.dataset.horarios, 10),
        materias: parseInt(datosDiv.dataset.materias, 10)
    };

    // Etiquetas y valores comunes
    const etiquetas = ["Estudiantes", "Usuarios", "Docentes", "Grados", "Horarios", "Materias"];
    const valores = [
        datos.estudiantes,
        datos.usuarios,
        datos.docentes,
        datos.grados,
        datos.horarios,
        datos.materias
    ];
    const colores = ["#461c68", "#7E08CA", "#333", "#6c4a83"];

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
            labels: ["Estudiantes", "Usuarios", "Docentes", "Grados", "Horarios", "Materias"],
            datasets: [{
                label: "Evolución",
                data: [
                    datos.estudiantes,
                    datos.usuarios,
                    datos.docentes,
                    datos.grados,
                    datos.horarios,
                    datos.materias
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
